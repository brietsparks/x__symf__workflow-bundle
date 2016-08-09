<?php namespace Bsapaka\WorkflowBundle;


class WorkflowController
{

    /**
     * @var Workflow
     */
    protected $workflow;

    /**
     * @var array
     */
    protected $submitHandlers;

    protected $nextStep;

    public function processStepCompletion()
    {
        $step = $this->getCurrentStep();
        $handler = $this->getSubmitHandler($step->getPath());
            
        if ($handler) {
            $handler->handle();
        } elseif ($handle = $step->getSubmitHandlerCallable()) {
            $handle();
        } else {
            // TODO: throw no handler exception OR do nothing OR
            throw new \Exception();
        }

        if ($handler) {
            $nextStep = $this->getStepByPath($handler->getNextStepPath());
        } elseif ($getNextStep = $step->getNextStepCallable()) {
            $nextStep = $getNextStep();
        } else {
            // TODO: throw no next step exception OR implement a default next step handler
            throw new \Exception();
        }

        $this->setNextStep($nextStep);
    }

    /**
     * @param string $path
     *
     * @return Step
     */
    public function getStepByPath($path)
    {
    }

    protected function setNextStep(Step $step)
    {
        $this->nextStep = $step;
    }

    /**
     * @param $path
     * @return SubmitHandlerInterface
     */
    public function getSubmitHandler($path)
    {
        // iterate the submitHandlers array and return if found
    }

    /**
     * @param SubmitHandlerInterface $handler
     *
     * @return $this
     */
    public function addSubmitHandler(SubmitHandlerInterface $handler)
    {
        $path = $handler->getStepPath();

        if (!array_key_exists($path, $this->submitHandlers)) {
            $this->submitHandlers[$path] = $handler;
        } else {
            // TODO: throw new exception
            $msg = "Workflow Manager already has submitHandler for the Step path '{$path}'.";
        }

        return $this;
    }

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

    /**
     * @return Step
     */
    public function getCurrentStep()
    {
    }



}