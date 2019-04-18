<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Media\ImageDefinition\ImageDefinitionConfigurator;

/** @var ImageDefinitionConfigurator $imageDefinition */
/**
 * @deprecated
 *
 */
$imageDefinition->addDirectory(\getcwd() . '/src/App/Media', true);


$imageDefinition->addDirectory(\getcwd() . '/src/App/Image', true);
