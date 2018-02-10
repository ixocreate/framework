<?php
declare(strict_types=1);
namespace KiwiSuite\Framework;

use KiwiSuite\Application\ConfiguratorItem\ConfiguratorRegistry;
use KiwiSuite\Application\Module\ModuleInterface;
use KiwiSuite\Application\Service\ServiceRegistry;
use KiwiSuite\ApplicationConsole\Bootstrap\ConsoleApplicationBootstrap;
use KiwiSuite\ApplicationHttp\Bootstrap\ApplicationHttpBootstrap;
use KiwiSuite\CommonTypes\Bootstrap\CommonTypesBootstrap;
use KiwiSuite\Database\Bootstrap\DatabaseBootstrap;
use KiwiSuite\Entity\Bootstrap\EntityBootstrap;
use KiwiSuite\ProjectUri\Bootstrap\ProjectUriBootstrap;
use KiwiSuite\ServiceManager\ServiceManager;

final class Module implements ModuleInterface
{

    /**
     * @param ConfiguratorRegistry $configuratorRegistry
     */
    public function configure(ConfiguratorRegistry $configuratorRegistry): void
    {
    }

    /**
     * @param ServiceRegistry $serviceRegistry
     */
    public function addServices(ServiceRegistry $serviceRegistry): void
    {
    }

    /**
     * @return array|null
     */
    public function getConfiguratorItems(): ?array
    {
        return null;
    }

    /**
     * @return array|null
     */
    public function getDefaultConfig(): ?array
    {
        return null;
    }

    /**
     * @param ServiceManager $serviceManager
     */
    public function boot(ServiceManager $serviceManager): void
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
        return null;
    }

    /**
     * @return array|null
     */
    public function getBootstrapItems(): ?array
    {
        return [
            ConsoleApplicationBootstrap::class,
            ApplicationHttpBootstrap::class,
            EntityBootstrap::class,
            CommonTypesBootstrap::class,
            DatabaseBootstrap::class,
            ProjectUriBootstrap::class,
        ];
    }
}
