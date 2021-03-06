<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Resource\ResourceConfigurator;

/** @var ResourceConfigurator $resource */
$resource->addDirectory(\getcwd() . '/src/Admin/Resource', true);
$resource->addDirectory(\getcwd() . '/src/App/Resource', true);
