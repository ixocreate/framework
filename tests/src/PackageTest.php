<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Test;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Service\ServiceManagerBootstrapItem;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Framework\Package;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    public function testPackage()
    {
        $configuratorRegistry = $this->configuratorRegistryMock();
        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();

        $package = new Package();
        $package->configure($configuratorRegistry);
        $package->addServices($serviceRegistry);
        $package->boot($serviceManager);

        $this->assertNotNull($package->getBootstrapItems());
        $this->assertNotNull($package->getConfigDirectory());
        $this->assertNull($package->getConfigProvider());
        $this->assertNotNull($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }

    private function configuratorRegistryMock()
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
}
