<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\CommandBus\Configurator;
use Ixocreate\Package\CommandBus\Handler\ExecutionHandler;
use Ixocreate\Package\CommandBus\FilterHandler;
use Ixocreate\Package\CommandBus\ValidationHandler;

/** @var Configurator $commandBus */

$commandBus->addHandler(FilterHandler::class, null, 1000001);
$commandBus->addHandler(ValidationHandler::class, null, 1000000);
$commandBus->addHandler(ExecutionHandler::class, null, 0);
