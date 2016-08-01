<?php

namespace Bsapaka\WorkflowBundle\FormLoader;

use Symfony\Component\Form\FormInterface;

interface FormLoaderInterface
{

    /**
     * @return FormInterface
     */
    public function getForm();
}