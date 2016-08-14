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
    public function getSlug()
    {
        return $this->getConfig()->getSlug();
    }



    /* ========== Maybe using maybe not ========== */
    #region maybe using maybe not
    /**
     * @return callable
     */
    public function getSubmitHandlerCallable()
    {
        return $this->getConfig()->getSubmitHandlerCallable();
    }

    /**
     * @return callable
     */
    public function getNextStepCallable()
    {
        return $this->getConfig()->getNextStepCallable();
    }
    #endregion
    /* ==========            end          ========== */



    /**
     * @return array
     */
    public function getPathArray()
    {
        $namePath[] = $this->getSlug();

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
        return join("/", $this->getPathArray());
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