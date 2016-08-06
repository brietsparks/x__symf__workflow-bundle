<?php

namespace Bsapaka\WorkflowBundle;

class WorkflowBuilder
{

    /**
     * @var Workflow
     */
    protected $workflow;

    public function addWorkflow($name, $urlSegment, array $options = [], callable $build)
    {
        $config = new Config();

    }

    /**
     * @return Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

}