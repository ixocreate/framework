<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Role\AdministratorRole;
use KiwiSuite\Admin\Role\RoleInterface;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
/** @var ServiceManagerConfigurator $adminRoleConfigurator */

$adminRoleConfigurator->addDirectory(getcwd() . '/src/App/Admin/Role', true, [RoleInterface::class]);
