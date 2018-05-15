<?php
declare(strict_types=1);

namespace KiwiSuite\Framwork;

use KiwiSuite\Media\ImageDefinition\ImageDefinitionConfigurator;

/** @var ImageDefinitionConfigurator $imageDefinition */
$imageDefinition->addDirectory(\getcwd() . '/src/App/Media', true);