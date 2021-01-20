<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Http\Middleware\Factory\SegmentMiddlewareFactory;
use Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Application\Http\Middleware\RootRequestWrapperMiddleware;
use Ixocreate\Application\Http\Middleware\SegmentMiddlewarePipe;
use Ixocreate\Application\Uri\Middleware\ApplicationUriCheckMiddleware;
use Ixocreate\Framework\Http\ErrorHandling\Factory\ErrorHandlerFactory;
use Ixocreate\Framework\Http\ErrorHandling\Factory\NotFoundHandlerFactory;
use Ixocreate\Framework\Http\ErrorHandling\Response\NotFoundHandler;
use Laminas\Stratigility\Middleware\ErrorHandler;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(ApplicationUriCheckMiddleware::class);

$middleware->addDirectory(\getcwd() . '/src/App/Action', true);
$middleware->addDirectory(\getcwd() . '/src/Admin/Action', true);
$middleware->addDirectory(\getcwd() . '/src/App/Middleware', true);
$middleware->addDirectory(\getcwd() . '/src/Admin/Middleware', true);


//ErrorHandler & NotFoundHandler
$middleware->addMiddleware(ErrorHandler::class, ErrorHandlerFactory::class);
$middleware->addMiddleware(NotFoundHandler::class, NotFoundHandlerFactory::class);
$middleware->addMiddleware(RootRequestWrapperMiddleware::class);

$middleware->addMiddleware(SegmentMiddlewarePipe::class, SegmentMiddlewareFactory::class);
