<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Test;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Console\ConsoleBootstrapItem;
use Ixocreate\Application\Http\Middleware\MiddlewareBootstrapItem;
use Ixocreate\Application\Http\Pipe\PipeBootstrapItem;
use Ixocreate\Application\Publish\PublishBootstrapItem;
use Ixocreate\Application\Publish\PublishDefinitionBootstrapItem;
use Ixocreate\Application\Service\ServiceManagerBootstrapItem;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Application\Uri\ApplicationUriBootstrapItem;
use Ixocreate\Framework\Package;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    private function mockConfiguratorRegistry()
    {
        $mock = $this->createMock(ConfiguratorRegistryInterface::class);
        $mock->method('get')
            ->willReturnCallback(function ($request) {
                switch ($request) {
                    case ServiceManagerBootstrapItem::class:
                        return (new ServiceManagerBootstrapItem())->getConfigurator();
                }
                return null;
            });
        return $mock;
    }

    /**
     * @covers \Ixocreate\Framework\Package
     */
    public function testPackage()
    {
        $configuratorRegistry = $this->mockConfiguratorRegistry();
        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();

        $package = new Package();
        $package->configure($configuratorRegistry);
        $package->addServices($serviceRegistry);
        $package->boot($serviceManager);

        $this->assertSame([
            ApplicationUriBootstrapItem::class,
            PublishDefinitionBootstrapItem::class,
            PublishBootstrapItem::class,
            MiddlewareBootstrapItem::class,
            PipeBootstrapItem::class,
            ConsoleBootstrapItem::class,
        ], $package->getBootstrapItems());
        $this->assertDirectoryExists($package->getConfigDirectory());
        $this->assertNull($package->getConfigProvider());
        $this->assertNotNull($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}
