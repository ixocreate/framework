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

use KiwiSuite\ApplicationConsole\BootstrapItem\ConsoleBootstrapItem;
use KiwiSuite\ApplicationConsole\Console\ConsoleRunner;
use KiwiSuite\ApplicationConsole\Console\Factory\ConsoleRunnerFactory;
use KiwiSuite\ApplicationConsole\ConsoleConfigurator;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ApplicationHttp\BootstrapItem\MiddlewareBootstrapItem;
use KiwiSuite\ApplicationHttp\BootstrapItem\PipeBootstrapItem;
use KiwiSuite\ApplicationHttp\Factory\FastRouterFactory;
use KiwiSuite\ApplicationHttp\Factory\RequestHandlerRunnerFactory;
use KiwiSuite\ApplicationHttp\Middleware\Factory\SegmentMiddlewareFactory;
use KiwiSuite\ApplicationHttp\Middleware\MiddlewareConfigurator;
use KiwiSuite\ApplicationHttp\Middleware\MiddlewareSubManager;
use KiwiSuite\ApplicationHttp\Middleware\SegmentMiddlewarePipe;
use KiwiSuite\CommandBus\BootstrapItem\HandlerBootstrapItem;
use KiwiSuite\CommandBus\BootstrapItem\MessageBootstrapItem;
use KiwiSuite\CommandBus\CommandBus;
use KiwiSuite\CommandBus\Console\ConsumeCommand;
use KiwiSuite\CommandBus\Consumer\Consumer;
use KiwiSuite\CommandBus\Consumer\Factory\ConsumerFactory;
use KiwiSuite\CommandBus\Factory\CommandBusFactory;
use KiwiSuite\CommandBus\Handler\HandlerSubManager;
use KiwiSuite\CommandBus\Message\MessageSubManager;
use KiwiSuite\CommandBus\QueueFactory\PersistentFactory;
use KiwiSuite\CommonTypes\Bootstrap\CommonTypesBootstrap;
use KiwiSuite\Contract\Application\ConfiguratorRegistryInterface;
use KiwiSuite\Contract\Application\PackageInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use KiwiSuite\Database\BootstrapItem\RepositoryBootstrapItem;
use KiwiSuite\Database\Command\GenerateClassesCommand;
use KiwiSuite\Database\Command\GenerateCommand;
use KiwiSuite\Database\Command\GenerateEntitiesCommand;
use KiwiSuite\Database\Command\GenerateMetadataCommand;
use KiwiSuite\Database\Command\GenerateRepositoriesCommand;
use KiwiSuite\Database\Command\GenerateResourcesCommand;
use KiwiSuite\Database\Command\MigrateCommand;
use KiwiSuite\Database\Command\StatusCommand;
use KiwiSuite\Database\Command\VersionCommand;
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
use KiwiSuite\ProjectUri\ConfigProvider as ProjectUriConfigProvider;
use KiwiSuite\ProjectUri\Factory\ProjectUriFactory;
use KiwiSuite\ProjectUri\Middleware\ProjectUriCheckMiddleware;
use KiwiSuite\ProjectUri\ProjectUri;
use KiwiSuite\ServiceManager\BootstrapItem\ServiceManagerBootstrapItem;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
use KiwiSuite\Template\BootstrapItem\TemplateBootstrapItem;
use KiwiSuite\Template\Extension\ExtensionSubManager;
use KiwiSuite\Template\Factory\TemplateRendererFactory;
use KiwiSuite\Template\Middleware\TemplateMiddleware;
use KiwiSuite\Template\Renderer;
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

        $serviceManagerConfigurator->addSubManager(HandlerSubManager::class);
        $serviceManagerConfigurator->addSubManager(MessageSubManager::class);
        $serviceManagerConfigurator->addFactory(CommandBus::class, CommandBusFactory::class);
        $serviceManagerConfigurator->addFactory(PersistentFactory::class, \KiwiSuite\CommandBus\QueueFactory\Factory\PersistentFactory::class);
        $serviceManagerConfigurator->addFactory(Consumer::class, ConsumerFactory::class);

        /** @var MiddlewareConfigurator $middlewareConfigurator */
        $middlewareConfigurator = $configuratorRegistry->get(MiddlewareBootstrapItem::class);
        $middlewareConfigurator->addMiddleware(SegmentMiddlewarePipe::class, SegmentMiddlewareFactory::class);
        $middlewareConfigurator->addMiddleware(ProjectUriCheckMiddleware::class);
        $middlewareConfigurator->addMiddleware(TemplateMiddleware::class);

        $serviceManagerConfigurator->addSubManager(ConnectionSubManager::class, ConnectionSubManagerFactory::class);
        $serviceManagerConfigurator->addSubManager(RepositorySubManager::class);
        $serviceManagerConfigurator->addSubManager(EntityManagerSubManager::class, EntityManagerSubManagerFactory::class);

        /** @var ConsoleConfigurator $consoleConfigurator */
        $consoleConfigurator = $configuratorRegistry->get(ConsoleBootstrapItem::class);

        $consoleConfigurator->addCommand(GenerateCommand::class);
        $consoleConfigurator->addCommand(MigrateCommand::class);
        $consoleConfigurator->addCommand(StatusCommand::class);
        $consoleConfigurator->addCommand(VersionCommand::class);
        $consoleConfigurator->addCommand(GenerateEntitiesCommand::class);
        $consoleConfigurator->addCommand(GenerateRepositoriesCommand::class);
        $consoleConfigurator->addCommand(GenerateResourcesCommand::class);
        $consoleConfigurator->addCommand(GenerateMetadataCommand::class);
        $consoleConfigurator->addCommand(GenerateClassesCommand::class);
        $consoleConfigurator->addCommand(ConsumeCommand::class);
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
        return null;
    }

    /**
     * @return array|null
     */
    public function getBootstrapItems(): ?array
    {
        return [
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
