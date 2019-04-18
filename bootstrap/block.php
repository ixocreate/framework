<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Cms\Package\Block\BlockConfigurator;

/** @var BlockConfigurator $block */

$block->addDirectory(getcwd() . '/src/App/Block', true);
