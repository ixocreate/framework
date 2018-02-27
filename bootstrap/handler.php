<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $handlerConfigurator */
use KiwiSuite\CommandBus\Handler\HandlerInterface;

$handlerConfigurator->addDirectory( getcwd() . '/src/App/Handler', true, [HandlerInterface::class]);
$handlerConfigurator->addDirectory( getcwd() . '/src/App/Admin/Handler', true, [HandlerInterface::class]);


