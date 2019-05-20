<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge;

use Denbad\RelativeDateSymfonyBridge\DependencyInjection\Compiler\PostConfigure;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class RelativeDateBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new PostConfigure(), PassConfig::TYPE_OPTIMIZE);
    }
}