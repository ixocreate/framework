<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Cms\PageType\PageTypeConfigurator;

/** @var PageTypeConfigurator $pageType */

$pageType->addDirectory(getcwd() . '/src/App/PageType', true);
