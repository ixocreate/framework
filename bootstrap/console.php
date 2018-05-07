<?php
namespace KiwiSuite\Admin;

/** @var ConsoleConfigurator $console */
use KiwiSuite\Application\Console\BootstrapGenerateCommand;
use KiwiSuite\Application\Console\BootstrapListCommand;
use KiwiSuite\Application\Console\PublishCommand;
use KiwiSuite\Application\Console\PublishListCommand;
use KiwiSuite\ApplicationConsole\ConsoleConfigurator;

$console->addCommand(BootstrapListCommand::class);
$console->addCommand(BootstrapGenerateCommand::class);
$console->addCommand(PublishCommand::class);
$console->addCommand(PublishListCommand::class);

$console->addDirectory(getcwd() . '/src/App/Console', true);
$console->addDirectory(getcwd() . '/src/Admin/Console', true);
