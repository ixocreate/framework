<?php
declare(strict_types=1);
namespace Framework;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $middlewareConfigurator */
$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Action');
$middlewareConfigurator->addDirectory(getcwd() . '/src/App/Middleware');

