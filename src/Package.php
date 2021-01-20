<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Console\ConsoleBootstrapItem;
use Ixocreate\Application\Console\ConsoleRunner;
use Ixocreate\Application\Console\ConsoleSubManager;
use Ixocreate\Application\Console\Factory\ConsoleRunnerFactory;
use Ixocreate\Application\Http\Factory\FastRouterFactory;
use Ixocreate\Application\Http\Factory\RequestHandlerRunnerFactory;
use Ixocreate\Application\Http\Middleware\MiddlewareBootstrapItem;
use Ixocreate\Application\Http\Middleware\MiddlewareSubManager;
use Ixocreate\Application\Http\Pipe\PipeBootstrapItem;
use Ixocreate\Application\Package\ConfigureAwareInterface;
use Ixocreate\Application\Package\PackageInterface;
use Ixocreate\Application\Publish\PublishBootstrapItem;
use Ixocreate\Application\ServiceManager\ServiceManagerBootstrapItem;
use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Application\Uri\ApplicationUriBootstrapItem;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Mezzio\Router\FastRouteRouter;

final class Package implements PackageInterface, ConfigureAwareInterface
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
     * @return null|string
     */
    public function getBootstrapDirectory(): ?string
    {
        return __DIR__ . '/../bootstrap';
    }

    /**
     * @return array
     */
    public function getBootstrapItems(): array
    {
        /**
         * register the application's bootstrap items
         * TODO: the application should probably do that by itself
         */
        return [
            ApplicationUriBootstrapItem::class,
            ConsoleBootstrapItem::class,
            MiddlewareBootstrapItem::class,
            PipeBootstrapItem::class,
            PublishBootstrapItem::class,
        ];
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        /**
         * require all the framework's default packages
         */
        return [
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
        ];
    }
}
