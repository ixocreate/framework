<?php
namespace KiwiSuite\Framework;

use KiwiSuite\ApplicationHttp\ErrorHandling\Response\NotFoundHandler;
use KiwiSuite\ApplicationHttp\Pipe\PipeConfigurator;
use KiwiSuite\ProjectUri\Middleware\ProjectUriCheckMiddleware;
use KiwiSuite\Template\Middleware\TemplateMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

/** @var PipeConfigurator $pipe */
$pipe->pipe(ErrorHandler::class, PHP_INT_MAX);
$pipe->pipe(ProjectUriCheckMiddleware::class, PHP_INT_MAX);
$pipe->pipe(TemplateMiddleware::class, PHP_INT_MAX);
$pipe->pipe(NotFoundHandler::class, PHP_INT_MAX * -1);
