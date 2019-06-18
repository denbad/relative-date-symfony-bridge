<?php

declare(strict_types=1);

namespace Denbad\RelativeDateSymfonyBridge\Tests\Integration\DependencyInjection;

use Denbad\RelativeDateSymfonyBridge\DependencyInjection\Configuration;
use Denbad\RelativeDateSymfonyBridge\DependencyInjection\DenbadRelativeDateExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ConfigurationTest extends \PHPUnit\Framework\TestCase
{
    private $root;
    private $extension;

    public function setUp(): void
    {
        $this->root = "DenbadRelativeDateBundle";
        $this->extension = $this->getExtension();
    }

    public function testGetConfigTreeBuilder(): void
    {

        $this->extension->load([], $container = $this->getContainer());
        
        dump($this->extension->getProcessedConfigs());

        //$this->assertTrue($container->hasParameter('denbad_relative_date' . ".default_strategy"));


        //dump($this->extension->getAlias());
        dump($this->extension->getConfiguration(['default_strategy' => 'aaa'],  $this->getContainer()  ));
        die;

    }

    protected function getExtension(): ExtensionInterface
    {
        return new DenbadRelativeDateExtension();
    }

    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }

    private function getContainer(): ContainerInterface
    {
        return new ContainerBuilder();
    }
}