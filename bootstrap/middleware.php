<?php
declare(strict_types=1);
namespace Framework;

/** @var MiddlewareConfigurator $middleware */
use KiwiSuite\ApplicationHttp\ErrorHandling\Factory\ErrorHandlerFactory;
use KiwiSuite\ApplicationHttp\ErrorHandling\Factory\NotFoundHandlerFactory;
use KiwiSuite\ApplicationHttp\ErrorHandling\Response\NotFoundHandler;
use KiwiSuite\ApplicationHttp\Middleware\Factory\SegmentMiddlewareFactory;
use KiwiSuite\ApplicationHttp\Middleware\MiddlewareConfigurator;
use KiwiSuite\ApplicationHttp\Middleware\SegmentMiddlewarePipe;
use Zend\Stratigility\Middleware\ErrorHandler;

$middleware->addDirectory(getcwd() . '/src/App/Action', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Action', true);
$middleware->addDirectory(getcwd() . '/src/App/Middleware', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Middleware', true);

//ErrorHandler & NotFoundHandler
$middleware->addMiddleware(ErrorHandler::class, ErrorHandlerFactory::class);
$middleware->addMiddleware(NotFoundHandler::class, NotFoundHandlerFactory::class);

$middleware->addMiddleware(SegmentMiddlewarePipe::class, SegmentMiddlewareFactory::class);

