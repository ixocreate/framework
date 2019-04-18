<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Application\Http\ErrorHandling\Factory\ErrorResponseGeneratorFactory;
use Ixocreate\Application\Http\ErrorHandling\Response\ErrorResponseGenerator;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addFactory(ErrorResponseGenerator::class, ErrorResponseGeneratorFactory::class);
