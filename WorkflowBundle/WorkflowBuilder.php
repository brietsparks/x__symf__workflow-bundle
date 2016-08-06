<?php

namespace Bsapaka\WorkflowBundle;

class WorkflowBuilder
{

    /**
     * @var Workflow
     */
    protected $workflow;

    public function add(WorkflowNode $workflowNode)
    {
        $this->workflow->add($workflowNode);

        return $this;
    }

    /**
     * @return Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

}