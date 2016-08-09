<?php

namespace Bsapaka\WorkflowBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FormLoaderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $this->findWorkflowManagerTags($container);
    }
    
    protected function findSubmitHandlerTags(ContainerBuilder $container)
    {
        if (!$container->has('bsapaka_workflow.workflow_controller')) {
            return;
        }

        $definition = $container->findDefinition(
            'bsapaka_workflow.workflow_controller'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'bsapaka_workflow.submit_handler'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSubmitHandler',
                array(new Reference($id))
            );
        }
    }

//    protected function findWorkflowManagerTags(ContainerBuilder $container)
//    {
//        if (!$container->has('bsapaka_workflow.workflow_controller')) {
//            return;
//        }
//
//        $definition = $container->findDefinition(
//            'bsapaka_workflow.workflow_controller'
//        );
//
//        $taggedServices = $container->findTaggedServiceIds(
//            'bsapaka_workflow.form_loader'
//        );
//
//        foreach ($taggedServices as $id => $tags) {
//            $definition->addMethodCall(
//                'addFormLoader',
//                array(new Reference($id))
//            );
//        }
//    }
    
}