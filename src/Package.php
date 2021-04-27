<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Package\PackageInterface;

final class Package implements PackageInterface
{
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
        return [];
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
