<?php

namespace Bsapaka\WorkflowBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('workflow');

        $rootNode
            ->children()
                ->scalarNode('default_template')->defaultNull()
                ->end()
            ->end();

        return $treeBuilder;

    }


}