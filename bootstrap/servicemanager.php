<?php
declare(strict_types=1);
namespace Framework;

use KiwiSuite\ApplicationHttp\ErrorHandling\Factory\ErrorResponseGeneratorFactory;
use KiwiSuite\ApplicationHttp\ErrorHandling\Response\ErrorResponseGenerator;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(ErrorResponseGenerator::class, ErrorResponseGeneratorFactory::class);