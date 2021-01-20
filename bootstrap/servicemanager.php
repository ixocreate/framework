<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Framework\Http\ErrorHandling\Factory\ErrorResponseGeneratorFactory;
use Ixocreate\Framework\Http\ErrorHandling\Response\ErrorResponseGenerator;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(ErrorResponseGenerator::class, ErrorResponseGeneratorFactory::class);
