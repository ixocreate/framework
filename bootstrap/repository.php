<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Database\Repository\RepositoryConfigurator;

/** @var RepositoryConfigurator $repository */

$repository->addDirectory( getcwd() . '/src/App/Repository', true);
$repository->addDirectory( getcwd() . '/src/Admin/Repository', true);
