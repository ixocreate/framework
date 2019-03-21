<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\BootstrapItem\PublishBootstrapItem;
use Ixocreate\Application\BootstrapItem\PublishDefinitionBootstrapItem;
use Ixocreate\ApplicationConsole\BootstrapItem\ConsoleBootstrapItem;
use Ixocreate\ApplicationConsole\Console\ConsoleRunner;
use Ixocreate\ApplicationConsole\Console\Factory\ConsoleRunnerFactory;
use Ixocreate\ApplicationConsole\ConsoleSubManager;
use Ixocreate\ApplicationHttp\BootstrapItem\MiddlewareBootstrapItem;
use Ixocreate\ApplicationHttp\BootstrapItem\PipeBootstrapItem;
use Ixocreate\ApplicationHttp\Factory\FastRouterFactory;
use Ixocreate\ApplicationHttp\Factory\RequestHandlerRunnerFactory;
use Ixocreate\ApplicationHttp\Middleware\MiddlewareSubManager;
use Ixocreate\Contract\Application\ConfiguratorRegistryInterface;
use Ixocreate\Contract\Application\PackageInterface;
use Ixocreate\Contract\Application\ServiceRegistryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
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
            \Ixocreate\Entity\Package::class,
            \Ixocreate\Database\Package::class,
            \Ixocreate\Template\Package::class,
            \Ixocreate\ProjectUri\Package::class,
            \Ixocreate\Filesystem\Package::class,
            \Ixocreate\CommonTypes\Package::class,
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
            \Ixocreate\Package\Cache\Package::class
        ];
    }
}
