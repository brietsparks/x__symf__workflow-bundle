<?php namespace Bsapaka\WorkflowBundle;


abstract class WorkflowNode
{

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var Workflow
     */
    protected $parent;

    /**
     * @var int
     */
    protected $index;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getConfig()->getName();
    }

    // TODO: path related methods should be in their own class
    // TODO: pathFinder, WorkflowTreeNavigator
    /**
     * @return array
     */
    public function getPathArray()
    {
        $namePath[] = $this->getName();

        if ($parent = $this->getParent()) {
            $namePath = array_merge($parent->getPathArray(), $namePath);
        }

        return $namePath;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return join(".", $this->getPathArray());
    }

    /**
     * @return ConfigInterface
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

        return $this;
    }

    /**
     * @return Workflow
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Workflow $parent
     * @return WorkflowNode
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        $this->getConfig()->inheritOptions(
            $parent->getConfig()->getOptions()
        );

        return $this;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param int $index
     * @return WorkflowNode
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }
}