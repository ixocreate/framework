<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Type\TypeConfigurator;

/** @var TypeConfigurator $type */

$type->addDirectory(getcwd() . '/src/App/Type', true);
$type->addDirectory(getcwd() . '/src/Admin/Type', true);
