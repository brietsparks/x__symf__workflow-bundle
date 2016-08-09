<?php
namespace Bsapaka\WorkflowBundle;

interface ConfigInterface
{

    /**
     * @param array $options
     */
    public function inheritOptions(array $options);

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getUrlSegment();

    /**
     * @return string
     */
    public function getTemplate();

    /**
     * @return string
     */
    public function getFormLoaderClass();

    /**
     * @return callable
     */
    public function getSubmitHandlerCallable();

    /**
     * @return callable
     */
    public function getNextStepCallable();

    /**
     * @return mixed
     */
    public function getPersistenceHandler();

}