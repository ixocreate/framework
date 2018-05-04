<?php
namespace KiwiSuite\Admin;

/** @var ConsoleConfigurator $console */
use KiwiSuite\Application\Console\BootstrapGenerateCommand;
use KiwiSuite\Application\Console\BootstrapListCommand;
use KiwiSuite\Application\Console\PublishCommand;
use KiwiSuite\Application\Console\PublishListCommand;
use KiwiSuite\ApplicationConsole\ConsoleConfigurator;
use KiwiSuite\CommandBus\Console\ConsumeCommand;
use KiwiSuite\Database\Command\GenerateClassesCommand;
use KiwiSuite\Database\Command\GenerateCommand;
use KiwiSuite\Database\Command\GenerateEntitiesCommand;
use KiwiSuite\Database\Command\GenerateMetadataCommand;
use KiwiSuite\Database\Command\GenerateRepositoriesCommand;
use KiwiSuite\Database\Command\GenerateResourcesCommand;
use KiwiSuite\Database\Command\MigrateCommand;
use KiwiSuite\Database\Command\StatusCommand;
use KiwiSuite\Database\Command\VersionCommand;

$console->addCommand(BootstrapListCommand::class);
$console->addCommand(BootstrapGenerateCommand::class);
$console->addCommand(GenerateCommand::class);
$console->addCommand(MigrateCommand::class);
$console->addCommand(StatusCommand::class);
$console->addCommand(VersionCommand::class);
$console->addCommand(GenerateEntitiesCommand::class);
$console->addCommand(GenerateRepositoriesCommand::class);
$console->addCommand(GenerateResourcesCommand::class);
$console->addCommand(GenerateMetadataCommand::class);
$console->addCommand(GenerateClassesCommand::class);
$console->addCommand(ConsumeCommand::class);
$console->addCommand(PublishCommand::class);
$console->addCommand(PublishListCommand::class);

$console->addDirectory(getcwd() . '/src/App/Console', true);
$console->addDirectory(getcwd() . '/src/Admin/Console', true);
