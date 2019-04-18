<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\CommandBus\Package\Configurator;
use Ixocreate\CommandBus\Package\Handler\ExecutionHandler;
use Ixocreate\CommandBus\Package\FilterHandler;
use Ixocreate\CommandBus\Package\ValidationHandler;

/** @var Configurator $commandBus */

$commandBus->addHandler(FilterHandler::class, null, 1000001);
$commandBus->addHandler(ValidationHandler::class, null, 1000000);
$commandBus->addHandler(ExecutionHandler::class, null, 0);
