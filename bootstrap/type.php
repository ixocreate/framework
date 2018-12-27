<?php
namespace Ixocreate\Admin;

use Ixocreate\Admin\Type\RoleType;
use Ixocreate\Entity\Type\TypeConfigurator;
use Ixocreate\Entity\Type\TypeInterface;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var TypeConfigurator $type */
$type->addDirectory(getcwd() . '/src/App/Type', true);
$type->addDirectory(getcwd() . '/src/Admin/Type', true);
