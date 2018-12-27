<?php
namespace Ixocreate\Admin;

/** @var ConsoleConfigurator $console */
use Ixocreate\Application\Console\BootstrapGenerateCommand;
use Ixocreate\Application\Console\BootstrapListCommand;
use Ixocreate\Application\Console\ConfigGenerateCommand;
use Ixocreate\Application\Console\ConfigListCommand;
use Ixocreate\Application\Console\PublishCommand;
use Ixocreate\Application\Console\PublishListCommand;
use Ixocreate\ApplicationConsole\ConsoleConfigurator;

$console->addCommand(BootstrapListCommand::class);
$console->addCommand(BootstrapGenerateCommand::class);
$console->addCommand(PublishCommand::class);
$console->addCommand(PublishListCommand::class);
$console->addCommand(ConfigListCommand::class);
$console->addCommand(ConfigGenerateCommand::class);

$console->addDirectory(getcwd() . '/src/App/Console', true);
$console->addDirectory(getcwd() . '/src/Admin/Console', true);
