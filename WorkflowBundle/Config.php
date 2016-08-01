<?php

namespace Bsapaka\WorkflowBundle;

class Config
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
     * @var bool
     */
    protected $validate;

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
        return $this->resolvePropertyValue('template');
    }

    /**
     * @return string
     */
    public function getFormLoaderClass()
    {
        return $this->resolvePropertyValue('formLoaderClass');
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
    protected function resolvePropertyValue($property, $inherit = true)
    {
        if (null === $this->$property &&
            true === $inherit &&
            $parentNode = $this->getNode()->getParent()
        ) {
            $getProperty = 'get' . $property;
            return $parentNode->getConfig()->$getProperty;
        } else {
            return $this->$property;
        }
    }
}