<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

/** @var \Ixocreate\Registry\Config\RegistryConfigurator $registry */

$registry->addDirectory(\getcwd() . '/src/Admin/Registry', true);
