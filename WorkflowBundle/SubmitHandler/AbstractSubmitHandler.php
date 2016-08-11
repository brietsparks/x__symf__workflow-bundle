<?php

namespace Bsapaka\WorkflowBundle;

class AbstractSubmitHandler
{

    /**
     * @var WorkflowController
     */
    protected $workflowController;

    /**
     * @param WorkflowController $workflowController
     * @return AbstractSubmitHandler
     */
    public function setWorkflowController($workflowController)
    {
        $this->workflowController = $workflowController;
    }

    public function handle()
    {
    }

    /**
     * @return string
     */
    public function getStepPath()
    {
    }

    /**
     * @return string
     */
    public function getNextStepPath()
    {
    }



}