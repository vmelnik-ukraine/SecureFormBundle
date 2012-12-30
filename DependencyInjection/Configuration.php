<?php

namespace VMelnik\SecureFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vmelnik_secure_form');

        // Grammar of config tree
        $rootNode
            ->children()
                ->scalarNode('enabled')
                    ->defaultTrue()
                ->end()
                ->scalarNode('enabled_option_name')
                    ->defaultValue('secure_form_enabled')
                ->end()
                ->scalarNode('ignore_fields_option_name')
                    ->defaultValue('secure_form_ignore_fields')
                ->end()
                ->arrayNode('csv')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('option_name')
                            ->defaultValue('secure_form_csv')
                        ->end()
                        ->scalarNode('class')
                            ->defaultValue('secure_form_field')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ssv')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('strip_tags')
                            ->children()
                                ->booleanNode('enabled')
                                    ->defaultTrue()
                                ->end()
                                ->scalarNode('option_name')
                                    ->defaultValue('secure_form_strip_tags')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        
        return $treeBuilder;
    }
}