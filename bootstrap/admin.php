<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

/** @var \Ixocreate\Admin\Config\AdminConfigurator $admin */

$admin->addDashboardProviderDirectory(getcwd() . '/src/Admin/Dashboard', true);
