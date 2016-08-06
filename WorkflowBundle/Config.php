<?php

namespace Bsapaka\WorkflowBundle;

class Config implements ConfigInterface
{

    /**
     * @var WorkflowNode
     */
    protected $node;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $urlSegment;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $formLoaderClass;

    /**
     * @var array
     */
    protected $formModifications;

    /**
     * @var string
     */
    protected $submitHandlerClass;


    protected $persistenceHandler;

    /**
     * @var array
     */
    protected $rolesWhitelist = [];

    /**
     * @var array
     */
    protected $rolesBlacklist = [];

    /**
     * @return WorkflowNode
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrlSegment()
    {
        if ($this->urlSegment) {
            return $this->urlSegment;
        } else {
            return $this->sluggify($this->getName());
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
     * @return string
     */
    public function getTemplate()
    {
        return $this->getProperty('template');
    }

    /**
     * @return string
     */
    public function getFormLoaderClass()
    {
        return $this->getProperty('formLoaderClass');
    }

    /**
     * @return string
     */
    public function getSubmitHandlerClass()
    {
        return $this->getProperty('submitHandlerClass');
    }

    /**
     * @return mixed
     */
    public function getPersistenceHandler()
    {
        return $this->getProperty('persistenceHandler');
    }

    /**
     * @return array
     */
    public function getRolesWhitelist()
    {
        return $this->getProperty('rolesWhitelist');
    }

    /**
     * @return array
     */
    public function getRolesBlacklist()
    {
        return $this->getProperty('rolesBlacklist');
    }

    /**
     * Get the value of a config property.
     *
     * If no value, then recurse up the composite tree until
     * a value is found or the top level parent is reached.
     *
     * @param string $property
     *
     * @return mixed
     */
    protected function getProperty($property, $inherit = true)
    {
        if (null === $this->$property &&
            true === $inherit &&
            $parentNode = $this->getNode()->getParent()
        ) {
            $getProperty = 'get' . $property;
            return $parentNode->getConfig()->$getProperty();
        } else {
            return $this->$property;
        }
    }

    # region Setters
    /**
     * @param WorkflowNode $node
     * @return Config
     */
    public function setNode($node)
    {
        $this->node = $node;

        return $this;
    }

    /**
     * @param string $name
     * @return Config
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $urlSegment
     * @return Config
     */
    public function setUrlSegment($urlSegment)
    {
        $this->urlSegment = $urlSegment;

        return $this;
    }

    /**
     * @param string $template
     * @return Config
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @param string $formLoaderClass
     * @return Config
     */
    public function setFormLoaderClass($formLoaderClass)
    {
        $this->formLoaderClass = $formLoaderClass;

        return $this;
    }

    /**
     * @param array $formModifications
     * @return Config
     */
    public function setFormModifications($formModifications)
    {
        $this->formModifications = $formModifications;

        return $this;
    }

    /**
     * @param string $submitHandlerClass
     * @return Config
     */
    public function setSubmitHandlerClass($submitHandlerClass)
    {
        $this->submitHandlerClass = $submitHandlerClass;

        return $this;
    }

    /**
     * @param mixed $persistenceHandler
     * @return Config
     */
    public function setPersistenceHandler($persistenceHandler)
    {
        $this->persistenceHandler = $persistenceHandler;

        return $this;
    }
    #Endregion

}