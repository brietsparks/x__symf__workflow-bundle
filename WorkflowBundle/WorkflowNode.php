<?php namespace Bsapaka\WorkflowBundle;


abstract class WorkflowNode
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var WorkflowNode
     */
    protected $parent;

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConfigInterface $config
     * @return WorkflowNode
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
        $config->setNode($this);

        return $this;
    }

    /**
     * @return WorkflowNode
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param WorkflowNode $parent
     * @return WorkflowNode
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

}