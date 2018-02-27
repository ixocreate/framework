<?php
namespace KiwiSuite\Admin;

/** @var ServiceManagerConfigurator $consoleServiceManagerConfigurator */
use KiwiSuite\ApplicationConsole\Command\CommandInterface;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

$consoleServiceManagerConfigurator->addDirectory(getcwd() . '/src/App/Console', true, [CommandInterface::class]);
