<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Service\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Console\Bootstrap\ConsoleBootstrapItem;
use Ixocreate\Application\Console\Console\ConsoleRunner;
use Ixocreate\Application\Console\Console\Factory\ConsoleRunnerFactory;
use Ixocreate\Application\Console\ConsoleSubManager;
use Ixocreate\Application\Http\Bootstrap\MiddlewareBootstrapItem;
use Ixocreate\Application\Http\Bootstrap\PipeBootstrapItem;
use Ixocreate\Application\Http\Factory\FastRouterFactory;
use Ixocreate\Application\Http\Factory\RequestHandlerRunnerFactory;
use Ixocreate\Application\Http\Middleware\MiddlewareSubManager;
use Ixocreate\Application\PackageInterface;
use Ixocreate\Application\Publish\Bootstrap\PublishBootstrapItem;
use Ixocreate\Application\Publish\Bootstrap\PublishDefinitionBootstrapItem;
use Ixocreate\Application\Service\Bootstrap\ServiceManagerBootstrapItem;
use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Application\Service\Registry\ServiceRegistryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
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
            \Ixocreate\Entity\Package::class,
            \Ixocreate\Database\Package::class,
            \Ixocreate\Template\Package::class,
            \Ixocreate\Filesystem\Package::class,
            \Ixocreate\Type\Package::class,
            \Ixocreate\CommandBus\Package::class,
            \Ixocreate\Asset\Package::class,
            \Ixocreate\Media\Package::class,
            \Ixocreate\Cms\Package::class,
            \Ixocreate\Intl\Package::class,
            \Ixocreate\Schema\Package::class,
            \Ixocreate\Registry\Package::class,
            \Ixocreate\Resource\Package::class,
            \Ixocreate\Event\Package::class,
            \Ixocreate\Translation\Package::class,
            \Ixocreate\Validation\Package::class,
            \Ixocreate\Filter\Package::class,
            \Ixocreate\Cache\Package::class,
            \Ixocreate\Mail\Package::class,
            \Ixocreate\Scheduler\Package::class,
            \Ixocreate\Log\Package::class,
        ];
    }
}
