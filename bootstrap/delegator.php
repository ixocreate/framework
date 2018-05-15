<?php
declare(strict_types=1);

namespace KiwiSuite\Framework;

use KiwiSuite\Media\Delegator\DelegatorConfigurator;

/** @var DelegatorConfigurator $delegator */
$delegator->addDirectory(getcwd() . '/src/App/Media', true);