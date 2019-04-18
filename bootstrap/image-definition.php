<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Media\Package\ImageDefinition\ImageDefinitionConfigurator;

/** @var ImageDefinitionConfigurator $imageDefinition */
/**
 * @deprecated
 *
 */
$imageDefinition->addDirectory(\getcwd() . '/src/App/Media', true);


$imageDefinition->addDirectory(\getcwd() . '/src/App/Image', true);
