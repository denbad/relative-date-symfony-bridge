<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\DependencyInjection\Compiler;

use Denbad\RelativeDate\Middleware\TranslatesMiddleware;
use Denbad\RelativeDateSymfonyBridge\Middleware\TranslatorAdapter;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class PostConfigure implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->getDefinition(TranslatesMiddleware::class)
            ->replaceArgument(0, new Reference(TranslatorAdapter::class))
        ;
    }
}