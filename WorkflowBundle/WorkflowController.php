<?php namespace Bsapaka\WorkflowBundle;


class WorkflowController
{

    /**
     * @var Workflow
     */
    protected $workflow;

    /**
     * @return Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param Workflow $workflow
     * @return WorkflowController
     */
    public function setWorkflow($workflow)
    {
        $this->workflow = $workflow;

        return $this;
    }

    public function getCurrentStep()
    {
        return 0;
    }



}