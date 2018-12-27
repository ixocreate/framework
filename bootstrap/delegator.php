<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Media\Delegator\DelegatorConfigurator;

/** @var DelegatorConfigurator $delegator */
$delegator->addDirectory(getcwd() . '/src/App/Media', true);
