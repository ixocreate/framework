<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $repositoryConfigurator */
use KiwiSuite\Database\Repository\RepositoryInterface;

$repositoryConfigurator->addDirectory( getcwd() . '/src/App/Repository', true, [RepositoryInterface::class]);
$repositoryConfigurator->addDirectory( getcwd() . '/src/App/Admin/Repository', true, [RepositoryInterface::class]);
