<?php

namespace Bsapaka\WorkflowBundle;

interface SubmitHandlerInterface
{

    public function handle();

    /**
     * @return string
     */
    public function getNextStepName();

}