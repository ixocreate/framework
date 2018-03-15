<?php
namespace KiwiSuite\Admin;

/** @var ConsoleConfigurator $console */
use KiwiSuite\ApplicationConsole\ConsoleConfigurator;

$console->addDirectory(getcwd() . '/src/App/Console', true);
$console->addDirectory(getcwd() . '/src/Admin/Console', true);
