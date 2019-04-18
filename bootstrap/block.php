<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Cms\Block\BlockConfigurator;

/** @var BlockConfigurator $block */

$block->addDirectory(getcwd() . '/src/App/Block', true);
