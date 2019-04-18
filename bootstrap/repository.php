<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Database\Package\Repository\RepositoryConfigurator;

/** @var RepositoryConfigurator $repository */

$repository->addDirectory( getcwd() . '/src/App/Repository', true);
$repository->addDirectory( getcwd() . '/src/Admin/Repository', true);
