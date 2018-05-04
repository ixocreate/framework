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
use KiwiSuite\Asset\Asset;
use KiwiSuite\Asset\Factory\AssetFactory;
use KiwiSuite\CommandBus\BootstrapItem\HandlerBootstrapItem;
use KiwiSuite\CommandBus\BootstrapItem\MessageBootstrapItem;
use KiwiSuite\CommandBus\CommandBus;
use KiwiSuite\CommandBus\Consumer\Consumer;
use KiwiSuite\CommandBus\Consumer\Factory\ConsumerFactory;
use KiwiSuite\CommandBus\Factory\CommandBusFactory;
use KiwiSuite\CommandBus\Handler\HandlerSubManager;
use KiwiSuite\CommandBus\Message\MessageSubManager;
use KiwiSuite\CommandBus\QueueFactory\PersistentFactory;
use KiwiSuite\Contract\Application\ConfiguratorRegistryInterface;
use KiwiSuite\Contract\Application\PackageInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use KiwiSuite\Database\BootstrapItem\RepositoryBootstrapItem;
use KiwiSuite\Database\ConfigProvider as DatabaseConfigProvider;
use KiwiSuite\Database\Connection\ConnectionConfig;
use KiwiSuite\Database\Connection\Factory\ConnectionConfigFactory;
use KiwiSuite\Database\Connection\Factory\ConnectionSubManager;
use KiwiSuite\Database\Connection\Factory\ConnectionSubManagerFactory;
use KiwiSuite\Database\EntityManager\Factory\EntityManagerSubManager;
use KiwiSuite\Database\EntityManager\Factory\EntityManagerSubManagerFactory;
use KiwiSuite\Database\Migration\Factory\MigrationConfigFactory;
use KiwiSuite\Database\Repository\Factory\RepositorySubManager;
use KiwiSuite\Database\Type\Strategy\RuntimeStrategy;
use KiwiSuite\Database\Type\TypeConfig;
use KiwiSuite\Entity\BootstrapItem\TypeBootstrapItem;
use KiwiSuite\Entity\Type\Type;
use KiwiSuite\Entity\Type\TypeSubManager;
use KiwiSuite\Filesystem\Adapter\Factory\FilesystemAdapterSubManagerFactory;
use KiwiSuite\Filesystem\Adapter\FilesystemAdapterSubManager;
use KiwiSuite\Filesystem\Storage\Factory\StorageConfigFactory;
use KiwiSuite\Filesystem\Storage\Factory\StorageSubManagerFactory;
use KiwiSuite\Filesystem\Storage\StorageConfig;
use KiwiSuite\Filesystem\Storage\StorageSubManager;
use KiwiSuite\ProjectUri\ConfigProvider as ProjectUriConfigProvider;
use KiwiSuite\ProjectUri\Factory\ProjectUriFactory;
use KiwiSuite\ProjectUri\ProjectUri;
use KiwiSuite\ServiceManager\BootstrapItem\ServiceManagerBootstrapItem;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
use KiwiSuite\Template\BootstrapItem\TemplateBootstrapItem;
use KiwiSuite\Template\Extension\ExtensionSubManager;
use KiwiSuite\Template\Factory\TemplateRendererFactory;
use KiwiSuite\Template\Renderer;
use KiwiSuite\Filesystem\ConfigProvider as FilesystemConfigProvider;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\HttpHandlerRunner\RequestHandlerRunner;
use Doctrine\DBAL\Migrations\Configuration\Configuration as MigrationConfiguration;

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

        $serviceManagerConfigurator->addFactory(ProjectUri::class, ProjectUriFactory::class);

        $serviceManagerConfigurator->addSubManager(TypeSubManager::class);

        $serviceManagerConfigurator->addFactory(ConnectionConfig::class, ConnectionConfigFactory::class);
        $serviceManagerConfigurator->addFactory(MigrationConfiguration::class, MigrationConfigFactory::class);

        $serviceManagerConfigurator->addFactory(Renderer::class, TemplateRendererFactory::class);
        $serviceManagerConfigurator->addSubManager(ExtensionSubManager::class);

        $serviceManagerConfigurator->addFactory(Asset::class, AssetFactory::class);

        $serviceManagerConfigurator->addSubManager(HandlerSubManager::class);
        $serviceManagerConfigurator->addSubManager(MessageSubManager::class);
        $serviceManagerConfigurator->addFactory(CommandBus::class, CommandBusFactory::class);
        $serviceManagerConfigurator->addFactory(PersistentFactory::class, \KiwiSuite\CommandBus\QueueFactory\Factory\PersistentFactory::class);
        $serviceManagerConfigurator->addFactory(Consumer::class, ConsumerFactory::class);

        $serviceManagerConfigurator->addSubManager(ConnectionSubManager::class, ConnectionSubManagerFactory::class);
        $serviceManagerConfigurator->addSubManager(RepositorySubManager::class);
        $serviceManagerConfigurator->addSubManager(EntityManagerSubManager::class, EntityManagerSubManagerFactory::class);

        $serviceManagerConfigurator->addFactory(StorageConfig::class, StorageConfigFactory::class);
        $serviceManagerConfigurator->addSubManager(FilesystemAdapterSubManager::class, FilesystemAdapterSubManagerFactory::class);
        $serviceManagerConfigurator->addSubManager(StorageSubManager::class, StorageSubManagerFactory::class);
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
        return [
            ProjectUriConfigProvider::class,
            DatabaseConfigProvider::class,
            FilesystemConfigProvider::class,
        ];
    }

    /**
     * @param ServiceManagerInterface $serviceManager
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function boot(ServiceManagerInterface $serviceManager): void
    {
        Type::initialize($serviceManager->get(TypeSubManager::class));

        $runtimeStrategy = new RuntimeStrategy();
        $runtimeStrategy->generate($serviceManager->get(TypeConfig::class));
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
            TypeBootstrapItem::class,
            \KiwiSuite\Database\BootstrapItem\TypeBootstrapItem::class,
            RepositoryBootstrapItem::class,
            HandlerBootstrapItem::class,
            MessageBootstrapItem::class,
            TemplateBootstrapItem::class,
        ];
    }
}
