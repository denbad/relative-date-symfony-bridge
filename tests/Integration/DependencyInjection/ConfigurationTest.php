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
        $configs = array(
            "scalar"     => "scalarValue",
            "array_node" => array(
                "val1" => "array_value_1",
                "val2" => "array_value_2",
            ),
        );

        $this->extension->load(array($configs), $container = $this->getContainer());

        $this->assertTrue($container->hasParameter($this->root . ".scalar"));
        $this->assertEquals("scalarValue", $container->getParameter($this->root . ".scalar"));

        $expected = array(
            "val1" => "array_value_1",
            "val2" => "array_value_2",
        );
        $this->assertTrue($container->hasParameter($this->root . ".array_node"));
        $this->assertEquals($expected, $container->getParameter($this->root . ".array_node"));
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