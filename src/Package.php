<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Application\BootstrapItem\PublishBootstrapItem;
use Ixocreate\Application\BootstrapItem\PublishDefinitionBootstrapItem;
use Ixocreate\Application\Console\BootstrapItem\ConsoleBootstrapItem;
use Ixocreate\Application\Console\Console\ConsoleRunner;
use Ixocreate\Application\Console\Console\Factory\ConsoleRunnerFactory;
use Ixocreate\Application\Console\ConsoleSubManager;
use Ixocreate\Application\Http\BootstrapItem\MiddlewareBootstrapItem;
use Ixocreate\Application\Http\BootstrapItem\PipeBootstrapItem;
use Ixocreate\Application\Http\Factory\FastRouterFactory;
use Ixocreate\Application\Http\Factory\RequestHandlerRunnerFactory;
use Ixocreate\Application\Http\Middleware\MiddlewareSubManager;
use Ixocreate\Application\ConfiguratorRegistryInterface;
use Ixocreate\Application\PackageInterface;
use Ixocreate\Application\ServiceRegistryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\BootstrapItem\ServiceManagerBootstrapItem;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\HttpHandlerRunner\RequestHandlerRunner;

final class Package implements PackageInterface
{
    /**
     * @param ConfiguratorRegistryInterface $configuratorRegistry
     */
    public function configure(ConfiguratorRegistryInterface $configuratorRegistry): void
    {
        /** @var ServiceManagerConfigurator $serviceManagerConfigurator */
        $serviceManagerConfigurator = $configuratorRegistry->get(ServiceManagerBootstrapItem::class);

        $serviceManagerConfigurator->addFactory(RequestHandlerRunner::class, RequestHandlerRunnerFactory::class);
        $serviceManagerConfigurator->addFactory(FastRouteRouter::class, FastRouterFactory::class);
        $serviceManagerConfigurator->addSubManager(MiddlewareSubManager::class);

        $serviceManagerConfigurator->addFactory(ConsoleRunner::class, ConsoleRunnerFactory::class);
        $serviceManagerConfigurator->addSubManager(ConsoleSubManager::class);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     */
    public function addServices(ServiceRegistryInterface $serviceRegistry): void
    {
    }

    /**
     * @return array|null
     */
    public function getConfigProvider(): ?array
    {
        return null;
    }

    /**
     * @param ServiceManagerInterface $serviceManager
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function boot(ServiceManagerInterface $serviceManager): void
    {
    }

    /**
     * @return null|string
     */
    public function getBootstrapDirectory(): ?string
    {
        return __DIR__ . '/../bootstrap';
    }

    /**
     * @return null|string
     */
    public function getConfigDirectory(): ?string
    {
        return __DIR__ . '/../config';
    }

    /**
     * @return array|null
     */
    public function getBootstrapItems(): ?array
    {
        return [
            PublishDefinitionBootstrapItem::class,
            PublishBootstrapItem::class,
            MiddlewareBootstrapItem::class,
            PipeBootstrapItem::class,
            ConsoleBootstrapItem::class,
        ];
    }

    /**
     * @return array|null
     */
    public function getDependencies(): ?array
    {
        return [
            \Ixocreate\Package\Entity\Package::class,
            \Ixocreate\Package\Database\Package::class,
            \Ixocreate\Package\Template\Package::class,
            \Ixocreate\Package\ProjectUri\Package::class,
            \Ixocreate\Package\Filesystem\Package::class,
            \Ixocreate\Package\Type\Package::class,
            \Ixocreate\Package\CommandBus\Package::class,
            \Ixocreate\Package\Asset\Package::class,
            \Ixocreate\Package\Media\Package::class,
            \Ixocreate\Package\Cms\Package::class,
            \Ixocreate\Package\Intl\Package::class,
            \Ixocreate\Package\Schema\Package::class,
            \Ixocreate\Package\Registry\Package::class,
            \Ixocreate\Package\Resource\Package::class,
            \Ixocreate\Package\Event\Package::class,
            \Ixocreate\Package\Translation\Package::class,
            \Ixocreate\Package\Validation\Package::class,
            \Ixocreate\Package\Filter\Package::class,
            \Ixocreate\Package\Cache\Package::class,
        ];
    }
}
