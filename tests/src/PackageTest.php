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
            ConsoleBootstrapItem::class,
            MiddlewareBootstrapItem::class,
            PipeBootstrapItem::class,
            PublishBootstrapItem::class,
            PublishDefinitionBootstrapItem::class,
        ], $package->getBootstrapItems());
        $this->assertDirectoryExists($package->getConfigDirectory());
        $this->assertNull($package->getConfigProvider());
        $this->assertSame([
            \Ixocreate\Asset\Package::class,
            \Ixocreate\Cache\Package::class,
            \Ixocreate\Cms\Package::class,
            \Ixocreate\CommandBus\Package::class,
            \Ixocreate\Database\Package::class,
            \Ixocreate\Entity\Package::class,
            \Ixocreate\Event\Package::class,
            \Ixocreate\Filesystem\Package::class,
            \Ixocreate\Filter\Package::class,
            \Ixocreate\Intl\Package::class,
            // \Ixocreate\Log\Package::class,
            \Ixocreate\Mail\Package::class,
            \Ixocreate\Media\Package::class,
            \Ixocreate\Registry\Package::class,
            \Ixocreate\Resource\Package::class,
            // \Ixocreate\Scheduler\Package::class,
            \Ixocreate\Schema\Package::class,
            \Ixocreate\Template\Package::class,
            \Ixocreate\Translation\Package::class,
            \Ixocreate\Validation\Package::class,
        ], $package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}
