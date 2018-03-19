<?php
namespace KiwiSuite\Admin;

/** @var ConsoleConfigurator $console */
use KiwiSuite\Application\Console\BootstrapGenerateCommand;
use KiwiSuite\Application\Console\BootstrapListCommand;
use KiwiSuite\ApplicationConsole\ConsoleConfigurator;

$console->addCommand(BootstrapListCommand::class);
$console->addCommand(BootstrapGenerateCommand::class);

$console->addDirectory(getcwd() . '/src/App/Console', true);
$console->addDirectory(getcwd() . '/src/Admin/Console', true);
