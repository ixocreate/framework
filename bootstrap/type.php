<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Type\RoleType;
use KiwiSuite\Entity\Type\TypeConfigurator;
use KiwiSuite\Entity\Type\TypeInterface;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

/** @var TypeConfigurator $type */
$type->addDirectory(getcwd() . '/src/App/Type', true);
$type->addDirectory(getcwd() . '/src/Admin/Type', true);
