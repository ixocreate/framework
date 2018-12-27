<?php
namespace Ixocreate\Framework;

use Ixocreate\ApplicationHttp\ErrorHandling\Response\NotFoundHandler;
use Ixocreate\ApplicationHttp\Middleware\RootRequestWrapperMiddleware;
use Ixocreate\ApplicationHttp\Pipe\PipeConfigurator;
use Ixocreate\ProjectUri\Middleware\ProjectUriCheckMiddleware;
use Ixocreate\Template\Middleware\TemplateMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

/** @var PipeConfigurator $pipe */
$pipe->pipe(ErrorHandler::class, PHP_INT_MAX);
$pipe->pipe(RootRequestWrapperMiddleware::class, PHP_INT_MAX);
$pipe->pipe(ProjectUriCheckMiddleware::class, PHP_INT_MAX);
$pipe->pipe(TemplateMiddleware::class, PHP_INT_MAX);
$pipe->pipe(NotFoundHandler::class, PHP_INT_MAX * -1);
