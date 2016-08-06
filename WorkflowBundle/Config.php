<?php

namespace Bsapaka\WorkflowBundle;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Config implements ConfigInterface
{

    /**
     * @var WorkflowNode
     */
    protected $node;

    /**
     * @var array
     */
    protected $rawOptions;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * Config constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->rawOptions = $options;

        $resolver = new OptionsResolver();
        $this->configureResolver($resolver);
        $this->optionsResolver = $resolver;

        $this->resolveOptions();
    }

    /**
     * @return void
     */
    public function resolveOptions()
    {
        $this->options = $this->optionsResolver->resolve($this->rawOptions);
    }

    /**
     * @return WorkflowNode
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @param WorkflowNode $node
     * @return Config
     */
    public function setNode(WorkflowNode $node)
    {
        $this->node = $node;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->options['name'];
    }

    /**
     * @return string
     */
    public function getUrlSegment()
    {
        if ($urlSegment = $this->options['url_segment']) {
            return $urlSegment;
        } else {
            return $this->sluggify($this->getName());
        }
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->options['template'];
    }

    /**
     * @return string
     */
    public function getFormLoaderClass()
    {
        return $this->options['form_loader_class'];
    }

    /**
     * @return string
     */
    public function getSubmitHandlerClass()
    {
        return $this->options['submit_handler_class'];
    }

    /**
     * @return mixed
     */
    public function getPersistenceHandler()
    {
        return $this->options['persistence_handler'];
    }

    /**
     * @return array
     */
    public function getRolesWhitelist()
    {
        return $this->options['roles_whitelist'];
    }

    /**
     * @return array
     */
    public function getRolesBlacklist()
    {
        return $this->options['roles_blacklist'];
    }

    /**
     * Get the value of a config option.
     *
     * If no value, then recurse through parents and return
     * their option value
     *
     * @param string $option
     *
     * @return mixed
     */
    public function getOption($option)
    {
        if (null === $this->options[$option] &&
            $node = $this->getNode() &&
            $parentNode = $this->getNode()->getParent()
        ) {
            return $parentNode->getConfig()->getOption($option);
        } else {
            return $this->options[$option];
        }
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function sluggify($string)
    {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', "-", $string);
        return $string;
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureResolver(OptionsResolver $resolver)
    {
        $this->defineOptions($resolver);

        $this->defineAllowedTypes($resolver);

        $this->defineInheritance($resolver);

        $resolver->isRequired('name');

        $resolver->setDefault('url_segment', function (Options $options) {
            return $this->sluggify($options['name']);
        });

    }

    protected function defineOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined([
            'name',
            'url_segment',
            'template',
            'form_loader_class',
            'submit_handler_class',
            'persistence_handler',
            'roles_whitelist',
            'roles_blacklist',
        ]);
    }

    protected function defineAllowedTypes(OptionsResolver $resolver)
    {
        // TODO: allowed types
//        $resolver->setAllowedTypes([
//            'name' => ['string','NULL'],
//            'url_segment' => ['string','NULL'],
//            'template' => ['string','NULL'],
//            'form_loader_class'=> ['string','NULL'],
//            'submit_handler_class' => ['string','NULL'],
//            // 'persistence_handler'  => ? , // TODO: persistence handler option
//            'roles_whitelist'  => 'array',
//            'roles_blacklist'  => 'array',
//        ]);
    }

    protected function defineInheritance(OptionsResolver $resolver)
    {
        $inheritables = [
            'template',
            'form_loader_class',
            'submit_handler_class',
            'persistence_handler',
            'roles_whitelist',
            'roles_blacklist',
        ];

        foreach ($inheritables as $inheritable) {
            $resolver->setDefault($inheritable,
                function (Options $options) use ($inheritable) {
                    return $this->getOption($inheritable);
                }
            );
        }
    }

}