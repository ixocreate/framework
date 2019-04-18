<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Media\Package\Delegator\DelegatorConfigurator;

/** @var DelegatorConfigurator $delegator */

$delegator->addDirectory(getcwd() . '/src/App/Media', true);
