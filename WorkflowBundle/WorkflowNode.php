<?php namespace Bsapaka\WorkflowBundle;


abstract class WorkflowNode
{

    protected $config;

    /**
     * @var WorkflowNode
     */
    protected $parent;

    public function getNextStep()
    {
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return WorkflowNode
     */
    public function getParent()
    {
        return $this->parent;
    }






}