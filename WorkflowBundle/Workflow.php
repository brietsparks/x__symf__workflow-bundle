<?php

namespace Bsapaka\WorkflowBundle;

class Workflow extends WorkflowNode
{

    /**
     * @var array
     */
    protected $children;

    /**
     * @param WorkflowNode $child
     * 
     * @return $this
     */
    public function add(WorkflowNode $child)
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }



}