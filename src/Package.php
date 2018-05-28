<?php
/**
 * kiwi-suite/framework (https://github.com/kiwi-suite/framework)
 *
 * @package kiwi-suite/framework
 * @see https://github.com/kiwi-suite/framework
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */
declare(strict_types=1);
namespace KiwiSuite\Framework;

use KiwiSuite\Application\BootstrapItem\PublishBootstrapItem;
use KiwiSuite\Application\BootstrapItem\PublishDefinitionBootstrapItem;
use KiwiSuite\ApplicationConsole\BootstrapItem\ConsoleBootstrapItem;
use KiwiSuite\ApplicationConsole\Console\ConsoleRunner;
use KiwiSuite\ApplicationConsole\Console\Factory\ConsoleRunnerFactory;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ApplicationHttp\BootstrapItem\MiddlewareBootstrapItem;
use KiwiSuite\ApplicationHttp\BootstrapItem\PipeBootstrapItem;
use KiwiSuite\ApplicationHttp\Factory\FastRouterFactory;
use KiwiSuite\ApplicationHttp\Factory\RequestHandlerRunnerFactory;
use KiwiSuite\ApplicationHttp\Middleware\MiddlewareSubManager;
use KiwiSuite\Contract\Application\ConfiguratorRegistryInterface;
use KiwiSuite\Contract\Application\PackageInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use KiwiSuite\ServiceManager\BootstrapItem\ServiceManagerBootstrapItem;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
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
            \KiwiSuite\Entity\Package::class,
            \KiwiSuite\Database\Package::class,
            \KiwiSuite\Template\Package::class,
            \KiwiSuite\ProjectUri\Package::class,
            \KiwiSuite\Filesystem\Package::class,
            \KiwiSuite\CommonTypes\Package::class,
            \KiwiSuite\CommandBus\Package::class,
            \KiwiSuite\Asset\Package::class,
            \KiwiSuite\Media\Package::class,
            \KiwiSuite\Cms\Package::class,
            \KiwiSuite\Intl\Package::class,
        ];
    }
}
