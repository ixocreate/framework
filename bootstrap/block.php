<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Cms\Block\BlockConfigurator;

/** @var BlockConfigurator $block */

$block->addDirectory(getcwd() . '/src/App/Block', true);
