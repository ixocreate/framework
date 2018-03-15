<?php
declare(strict_types=1);
namespace Framework;

/** @var MiddlewareConfigurator $middleware */
use KiwiSuite\ApplicationHttp\Middleware\MiddlewareConfigurator;

$middleware->addDirectory(getcwd() . '/src/App/Action', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Action', true);
$middleware->addDirectory(getcwd() . '/src/App/Middleware', true);
$middleware->addDirectory(getcwd() . '/src/Admin/Middleware', true);

