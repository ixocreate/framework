<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Admin\Config\AdminConfigurator;

/** @var AdminConfigurator $admin */

$admin->addDashboardProviderDirectory(getcwd() . '/src/Admin/Dashboard', true);
