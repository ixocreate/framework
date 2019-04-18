<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Media\Handler\MediaHandlerConfigurator;

/** @var MediaHandlerConfigurator $media */

$media->addDirectory(getcwd() . '/src/App/Media', true);
