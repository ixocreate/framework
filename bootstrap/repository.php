<?php
declare(strict_types=1);

namespace Ixocreate\Admin;

/** @var RepositoryConfigurator $repository */
use Ixocreate\Database\Repository\RepositoryConfigurator;

$repository->addDirectory( getcwd() . '/src/App/Repository', true);
$repository->addDirectory( getcwd() . '/src/Admin/Repository', true);
