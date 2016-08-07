<?php

namespace Bsapaka\WorkflowBundle;

class WorkflowBuilder
{

    /**
     * @var Workflow
     */
    protected $workflow;

    public function addWorkflow($child, $urlSegment = null, array $options = [], callable $build)
    {
        $config = new Config();
    }

    public function addStep($child, $urlSegment = null, array $options = [], callable $build)
    {
        if ($child instanceof StepTypeInterface) {

        }
    }

    /**
     * @return Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

}