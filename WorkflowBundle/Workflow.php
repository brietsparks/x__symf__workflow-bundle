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
        $this->children[] = $child;

        return $this;
    }

}