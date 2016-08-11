<?php namespace Bsapaka\WorkflowBundle;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;

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

    /**
     * @var Session
     */
    protected $session;



    public function processStepCompletion()
    {
        $step = $this->getCurrentStep();
        $handler = $this->getSubmitHandler($step->getPath());

        if ($handler) {
            $handler->setWorkflowController($this)->handle();
        } elseif ($handle = $step->getSubmitHandlerCallable()) {
            $handle($this);
        } else {
            // TODO: throw no handler exception OR do nothing OR
            throw new \Exception();
        }

        if ($handler) {
            $nextStep = $this->getStepByPath($handler->getNextStepPath());
        } elseif ($getNextStep = $step->getNextStepCallable()) {
            $nextStep = $getNextStep($this);
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
     * @param string $path
     * @return AbstractSubmitHandler
     */
    public function getSubmitHandler($path)
    {
        // TODO: iterate the submitHandlers array and return if found
    }

    /**
     * @param AbstractSubmitHandler $handler
     *
     * @return $this
     */
    public function addSubmitHandler(AbstractSubmitHandler $handler)
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

    /**
     * @return FormInterface
     */
    public function getCurrentForm()
    {
    }



}