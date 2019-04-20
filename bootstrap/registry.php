<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Registry\RegistryConfigurator;

/** @var RegistryConfigurator $registry */
$registry->addDirectory(\getcwd() . '/src/Admin/Registry', true);
