<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Role\RoleConfigurator;
/** @var RoleConfigurator $role */
$role->addDirectory(getcwd() . '/src/Admin/Role', true);
