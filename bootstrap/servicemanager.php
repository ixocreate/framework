<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\ApplicationHttp\ErrorHandling\Factory\ErrorResponseGeneratorFactory;
use Ixocreate\ApplicationHttp\ErrorHandling\Response\ErrorResponseGenerator;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addFactory(ErrorResponseGenerator::class, ErrorResponseGeneratorFactory::class);
