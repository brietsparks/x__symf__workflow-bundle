<?php
namespace Bsapaka\WorkflowBundle;

interface ConfigInterface
{

    public function resolveOptions();

    /**
     * @param string $option
     * @return mixed
     */
    public function getOption($option);

    /**
     * @return WorkflowNode
     */
    public function getNode();

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

//    /**
//     * @param WorkflowNode $node
//     * @return ConfigInterface
//     */
//    public function setNode($node);
//
//    /**
//     * @param string $name
//     * @return ConfigInterface
//     */
//    public function setName($name);
//
//    /**
//     * @param string $urlSegment
//     * @return ConfigInterface
//     */
//    public function setUrlSegment($urlSegment);
//
//    /**
//     * @param string $template
//     * @return ConfigInterface
//     */
//    public function setTemplate($template);
//
//    /**
//     * @param string $formLoaderClass
//     * @return ConfigInterface
//     */
//    public function setFormLoaderClass($formLoaderClass);
//
//    /**
//     * @param array $formModifications
//     * @return ConfigInterface
//     */
//    public function setFormModifications($formModifications);
//
//    /**
//     * @param string $submitHandlerClass
//     * @return ConfigInterface
//     */
//    public function setSubmitHandlerClass($submitHandlerClass);
//
//    /**
//     * @param mixed $persistenceHandler
//     * @return ConfigInterface
//     */
//    public function setPersistenceHandler($persistenceHandler);