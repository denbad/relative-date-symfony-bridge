<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection;

use Denbad\RelativeDate\Strategy\Strategy;
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
                    ->values([Strategy::STRATEGY_RELATIVE_DATE, Strategy::STRATEGY_RELATIVE_DATETIME])
                    ->defaultValue(Strategy::STRATEGY_RELATIVE_DATETIME)
                ->end()
                ->scalarNode('fallback_format')
                    ->defaultValue(Strategy::FALLBACK_FORMAT)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}