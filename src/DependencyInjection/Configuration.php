<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection;

use Denbad\RelativeDate\Format\Format;
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
                    ->values([Format::FORMAT_RELATIVE_DATE, Format::FORMAT_RELATIVE_DATETIME])
                    ->defaultValue(Format::FORMAT_RELATIVE_DATETIME)
                ->end()
                ->scalarNode('fallback_format')
                    ->defaultValue(Format::FALLBACK_FORMAT)
                ->end()
            ->end();

        return $treeBuilder;
    }
}