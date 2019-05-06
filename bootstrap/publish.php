<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Application\Publish\PublishConfigurator;

/** @var PublishConfigurator $publish */
$publish->addDefinition('migrations', \getcwd() . '/resources/migrations');
