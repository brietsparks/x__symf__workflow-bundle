<?php

namespace Bsapaka\WorkflowBundle;

use Symfony\Component\Form\FormInterface;

class Step extends WorkflowNode
{

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var bool
     */
    protected $formLoaded;

}