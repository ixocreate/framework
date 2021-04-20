<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Bootstrap\Console\BootstrapGenerateCommand;
use Ixocreate\Application\Bootstrap\Console\BootstrapListCommand;
use Ixocreate\Application\Console\ConsoleConfigurator;
use Ixocreate\Application\Publish\Console\PublishCommand;
use Ixocreate\Application\Publish\Console\PublishListCommand;
use Ixocreate\Framework\Console\PrepareAllConsole;
use Ixocreate\Framework\Console\PrepareApplicationConsole;
use Ixocreate\Framework\Console\PrepareDatabaseConsole;
use Ixocreate\Framework\Console\Factory\PrepareServiceManagerConsoleFactory;
use Ixocreate\Framework\Console\PrepareServiceManagerConsole;
use Ixocreate\Framework\Console\SetupConsole;

/** @var ConsoleConfigurator $console */
$console->addCommand(BootstrapListCommand::class);
$console->addCommand(BootstrapGenerateCommand::class);
$console->addCommand(PublishCommand::class);
$console->addCommand(PublishListCommand::class);
$console->addCommand(SetupConsole::class);
$console->addCommand(PrepareAllConsole::class);
$console->addCommand(PrepareApplicationConsole::class);
$console->addCommand(PrepareDatabaseConsole::class);
$console->addCommand(PrepareServiceManagerConsole::class, PrepareServiceManagerConsoleFactory::class);

$console->addDirectory(\getcwd() . '/src/App/Console', true);
$console->addDirectory(\getcwd() . '/src/Admin/Console', true);
