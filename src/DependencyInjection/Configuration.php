<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('denbad_relative_date');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->enumNode('default_strategy')
                    ->values(['relative-date', 'relative-datetime'])
                    ->defaultValue('relative-datetime')
                ->end()
                ->scalarNode('fallback_format')
                    ->defaultValue('d F Y')
                ->end()
            ->end();

        return $treeBuilder;
    }
}