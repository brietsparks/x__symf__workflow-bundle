<?php

namespace Bsapaka\WorkflowBundle;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Config implements ConfigInterface
{

    /**
     * The initial unresolved options
     *
     * @var array
     */
    protected $rawOptions;

    /**
     * Resolved options
     *
     * @var array
     */
    protected $options;

    /**
     * @var ConfigOptionsResolver
     */
    protected $resolver;

    /**
     * Config constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->rawOptions = $options;
        $this->resolver = new ConfigOptionsResolver();
        $this->options = $this->resolver->resolve($options);
    }

    /**
     * @param array $options
     */
    public function inheritOptions(array $options)
    {
        $this->options = $this->resolver->inherit($options, $this->options);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return $this->options[$option];
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->options['slug'];
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
     * @return callable
     */
    public function getSubmitHandlerCallable()
    {
        return $this->options['submit_handler_callable'];
    }

    /**
     * @return callable
     */
    public function getNextStepCallable()
    {
        return $this->options['next_step_callable'];
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
     * @return array
     */
    public function getPrerequisiteNodes()
    {
        return $this->options['prerequisite_nodes'];
    }

}