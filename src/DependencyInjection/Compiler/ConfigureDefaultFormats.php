<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection\Compiler;

use Denbad\RelativeDate\Formatter\CompositeFormatter;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class ConfigureDefaultFormats implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $config = $container->getExtensionConfig('denbad_relative_date');

        $container->getDefinition(CompositeFormatter::class)->setArgument(1, $config['default_strategy']);

        foreach (array_keys($container->findTaggedServiceIds('date_formatter.format')) as $serviceId) {
            $container->getDefinition($serviceId)->setArgument(0, $config['fallback_format']);
        }
    }
}