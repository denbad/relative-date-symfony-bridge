<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection;

use Denbad\RelativeDate\Middleware\TranslatesMiddleware;
use Denbad\RelativeDateSymfonyBridge\Middleware\TranslatorAdapter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Denbad\RelativeDate\Formatter\CompositeFormatter;

final class RelativeDateExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $this->configureDefaultFormats($config);
        $this->setTranslatorAdapter();
    }

    private function configureDefaultFormats(ContainerBuilder $container, array $config): void
    {
        $container->getDefinition(CompositeFormatter::class)->setArgument(1, $config['default_strategy']);

        foreach (array_keys($container->findTaggedServiceIds('date_formatter.format')) as $serviceId) {
            $container->getDefinition($serviceId)->setArgument(0, $config['fallback_format']);
        }
    }

    private function setTranslatorAdapter(ContainerBuilder $container): void
    {
        $container->getDefinition(TranslatesMiddleware::class)
            ->setArgument(0, new Reference(TranslatorAdapter::class))
        ;
    }
}