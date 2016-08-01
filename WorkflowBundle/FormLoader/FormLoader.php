<?php

namespace Bsapaka\WorkflowBundle\FormLoader;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;

class FormLoader implements FormLoaderInterface
{

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var string
     */
    protected $formType;

    /**
     * FormLoader constructor.
     *
     * @param FormFactory $formFactory
     */
    public function __construct(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->formFactory->create($this->getFormType());
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     * @return FormLoader
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

}