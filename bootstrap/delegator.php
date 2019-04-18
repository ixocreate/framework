<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Media\Delegator\DelegatorConfigurator;

/** @var DelegatorConfigurator $delegator */

$delegator->addDirectory(getcwd() . '/src/App/Media', true);
