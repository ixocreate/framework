<?php
namespace KiwiSuite\Admin;

use KiwiSuite\Admin\Resource\ResourceInterface;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $resourceConfigurator */
$resourceConfigurator->addDirectory(getcwd() . '/src/App/Admin/Resource', true, [ResourceInterface::class]);
