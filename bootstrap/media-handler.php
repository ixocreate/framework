<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Media\Handler\MediaHandlerConfigurator;

/** @var MediaHandlerConfigurator $media */
$media->addDirectory(\getcwd() . '/src/App/Media', true);
