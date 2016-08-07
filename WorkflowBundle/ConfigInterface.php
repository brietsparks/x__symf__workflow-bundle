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
     * @return string
     */
    public function getSubmitHandlerClass();

    /**
     * @return mixed
     */
    public function getPersistenceHandler();

}