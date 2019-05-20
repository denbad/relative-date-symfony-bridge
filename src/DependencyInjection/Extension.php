<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension as BaseExtension;

final class Extension extends BaseExtension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $translatesMiddleware = $container->getDefinition('Denbad\RelativeDate\Middleware\TranslatesMiddleware');

        // dump($translatesMiddleware->getArgument(0)); die;

        $translatesMiddleware
            ->replaceArgument(0, new Reference('Denbad\RelativeDateSymfonyBridge\Middleware\TranslatorAdapter'))
        ;
    }
}