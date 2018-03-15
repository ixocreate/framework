<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var HandlerConfigurator $handler */
use KiwiSuite\CommandBus\Handler\HandlerConfigurator;

$handler->addDirectory( getcwd() . '/src/App/Handler', true);
$handler->addDirectory( getcwd() . '/src/Admin/Handler', true);


