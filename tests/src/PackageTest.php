<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Test;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\ServiceManager\ServiceManagerBootstrapItem;
use Ixocreate\Framework\Package;
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
        $package = new Package();

        $this->assertEmpty($package->getBootstrapItems());

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
