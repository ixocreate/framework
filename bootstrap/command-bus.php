<?php
namespace KiwiSuite\Framework;

use KiwiSuite\CommandBus\Configurator;
use KiwiSuite\CommandBus\Handler\ExecutionHandler;
use KiwiSuite\CommandBusValidation\FilterHandler;
use KiwiSuite\CommandBusValidation\ValidationHandler;

/** @var Configurator $commandBus */
$commandBus->addHandler(FilterHandler::class, null, 1000001);
$commandBus->addHandler(ValidationHandler::class, null, 1000000);
$commandBus->addHandler(ExecutionHandler::class, null, 0);