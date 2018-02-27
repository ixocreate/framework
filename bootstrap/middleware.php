<?php
declare(strict_types=1);
namespace Framework;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $middlewareConfigurator */
use Psr\Http\Server\MiddlewareInterface;

$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Action', true, [MiddlewareInterface::class]);
$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Admin/Action', true, [MiddlewareInterface::class]);
$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Middleware', true, [MiddlewareInterface::class]);
$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Admin/Middleware', true, [MiddlewareInterface::class]);

