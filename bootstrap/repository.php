<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var RepositoryConfigurator $repository */
use KiwiSuite\Database\Repository\RepositoryConfigurator;

$repository->addDirectory( getcwd() . '/src/App/Repository', true);
$repository->addDirectory( getcwd() . '/src/Admin/Repository', true);
