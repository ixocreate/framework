<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Http\ErrorHandling\Factory\ErrorResponseGeneratorFactory;
use Ixocreate\Application\Http\ErrorHandling\Response\ErrorResponseGenerator;
use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(ErrorResponseGenerator::class, ErrorResponseGeneratorFactory::class);
