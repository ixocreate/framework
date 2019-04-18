<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Admin\Config\AdminConfigurator;

/** @var AdminConfigurator $admin */

$admin->addDashboardProviderDirectory(getcwd() . '/src/Admin/Dashboard', true);
