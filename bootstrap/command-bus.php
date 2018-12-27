<?php
namespace Ixocreate\Framework;

use Ixocreate\CommandBus\Configurator;
use Ixocreate\CommandBus\Handler\ExecutionHandler;
use Ixocreate\CommandBusFilter\FilterHandler;
use Ixocreate\CommandBusValidation\ValidationHandler;

/** @var Configurator $commandBus */
$commandBus->addHandler(FilterHandler::class, null, 1000001);
$commandBus->addHandler(ValidationHandler::class, null, 1000000);
$commandBus->addHandler(ExecutionHandler::class, null, 0);
