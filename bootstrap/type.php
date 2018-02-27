<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Type\RoleType;
use KiwiSuite\Entity\Type\TypeInterface;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $typeConfigurator */
$typeConfigurator->addDirectory(getcwd() . '/src/App/Type', true, [TypeInterface::class]);
