<?php

namespace Bsapaka\WorkflowBundle\Persistence;

use Bsapaka\WorkflowBundle\Step;

abstract class AbstractPersistenceStrategy
{

    /**
     * @var Step
     */
    protected $step;

    /**
     * @var mixed
     */
    protected $data;

    abstract function persist();

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param Step $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

}