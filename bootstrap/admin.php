<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Admin\Package\Config\AdminConfigurator;

/** @var AdminConfigurator $admin */

$admin->addDashboardProviderDirectory(getcwd() . '/src/Admin/Dashboard', true);
