<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\ApplicationHttp\ErrorHandling\Factory\ErrorHandlerFactory;
use Ixocreate\ApplicationHttp\ErrorHandling\Factory\NotFoundHandlerFactory;
use Ixocreate\ApplicationHttp\ErrorHandling\Response\NotFoundHandler;
use Ixocreate\ApplicationHttp\Middleware\Factory\SegmentMiddlewareFactory;
use Ixocreate\ApplicationHttp\Middleware\MiddlewareConfigurator;
use Ixocreate\ApplicationHttp\Middleware\RootRequestWrapperMiddleware;
use Ixocreate\ApplicationHttp\Middleware\SegmentMiddlewarePipe;
use Zend\Stratigility\Middleware\ErrorHandler;

/** @var MiddlewareConfigurator $middleware */

$middleware->addDirectory(getcwd() . '/src/App/Action', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Action', true);
$middleware->addDirectory(getcwd() . '/src/App/Middleware', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Middleware', true);

//ErrorHandler & NotFoundHandler
$middleware->addMiddleware(ErrorHandler::class, ErrorHandlerFactory::class);
$middleware->addMiddleware(NotFoundHandler::class, NotFoundHandlerFactory::class);
$middleware->addMiddleware(RootRequestWrapperMiddleware::class);

$middleware->addMiddleware(SegmentMiddlewarePipe::class, SegmentMiddlewareFactory::class);

