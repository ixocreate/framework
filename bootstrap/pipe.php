<?php
namespace KiwiSuite\Framework;

use KiwiSuite\Admin\Pipe\PipeConfigurator;
use KiwiSuite\ApplicationHttp\ErrorHandling\Response\NotFoundHandler;
use KiwiSuite\Template\Middleware\TemplateMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

/** @var PipeConfigurator $pipe */
$pipe->pipe(TemplateMiddleware::class);

// ErrorHandler (most outer Middleware), NotFoundHandler(most inner Middleware)
$pipe->pipe(ErrorHandler::class, PHP_INT_MAX);
$pipe->pipe(NotFoundHandler::class, PHP_INT_MAX * -1);