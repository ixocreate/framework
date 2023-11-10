<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Http\Middleware\RootRequestWrapperMiddleware;
use Ixocreate\Application\Http\Pipe\PipeConfigurator;
use Ixocreate\Application\Uri\Middleware\ApplicationUriCheckMiddleware;
use Ixocreate\Framework\Http\ErrorHandling\Response\NotFoundHandler;
use Ixocreate\Template\Middleware\TemplateMiddleware;
use Laminas\Stratigility\Middleware\ErrorHandler;

/** @var PipeConfigurator $pipe */
$pipe->pipe(ErrorHandler::class, PHP_INT_MAX - 100);
$pipe->pipe(RootRequestWrapperMiddleware::class, PHP_INT_MAX - 200);
$pipe->pipe(ApplicationUriCheckMiddleware::class, PHP_INT_MAX - 300);
$pipe->pipe(TemplateMiddleware::class, PHP_INT_MAX - 400);
$pipe->pipe(NotFoundHandler::class, (PHP_INT_MAX * -1) + 100);
