<?php
declare(strict_types=1);

namespace KiwiSuite\Framwork;

use KiwiSuite\Media\ImageDefinition\ImageDefinitionConfigurator;

/** @var ImageDefinitionConfigurator $imageDefinition */
/**
 * @deprecated
 *
 */
$imageDefinition->addDirectory(\getcwd() . '/src/App/Media', true);


$imageDefinition->addDirectory(\getcwd() . '/src/App/Image', true);