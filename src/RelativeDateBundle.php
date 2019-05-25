<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge;

use Denbad\RelativeDateSymfonyBridge\DependencyInjection\Compiler\ConfigureDefaultFormats;
use Denbad\RelativeDateSymfonyBridge\DependencyInjection\Compiler\SetTranslatorAdapter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class RelativeDateBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container
            ->addCompilerPass(new ConfigureDefaultFormats())
            ->addCompilerPass(new SetTranslatorAdapter(), PassConfig::TYPE_OPTIMIZE)
        ;
    }
}