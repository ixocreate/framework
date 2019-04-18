<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Resource\SubManager\ResourceConfigurator;

/** @var ResourceConfigurator $resource */

$resource->addDirectory(getcwd() . '/src/Admin/Resource', true);
$resource->addDirectory(getcwd() . '/src/App/Resource', true);
