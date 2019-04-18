<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Application\Http\ErrorHandling\Response\NotFoundHandler;
use Ixocreate\Application\Http\Middleware\RootRequestWrapperMiddleware;
use Ixocreate\Application\Http\Pipe\PipeConfigurator;
use Ixocreate\Application\Uri\Middleware\ApplicationUriCheckMiddleware;
use Ixocreate\Template\Package\Middleware\TemplateMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

/** @var PipeConfigurator $pipe */

$pipe->pipe(ErrorHandler::class, PHP_INT_MAX);
$pipe->pipe(RootRequestWrapperMiddleware::class, PHP_INT_MAX);
$pipe->pipe(ApplicationUriCheckMiddleware::class, PHP_INT_MAX);
$pipe->pipe(TemplateMiddleware::class, PHP_INT_MAX);
$pipe->pipe(NotFoundHandler::class, PHP_INT_MAX * -1);
