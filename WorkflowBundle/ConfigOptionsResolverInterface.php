<?php namespace Bsapaka\WorkflowBundle;


interface ConfigOptionsResolverInterface
{

    /**
     * @param array $options
     * @return array
     */
    public function resolve(array $options = []);

    /**
     * @param array $parentOptions
     * @param array $originalOptions
     * @return mixed
     */
    public function inherit(array $parentOptions, array $originalOptions);


}