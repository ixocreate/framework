<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Cms\Package\PageType\PageTypeConfigurator;

/** @var PageTypeConfigurator $pageType */

$pageType->addDirectory(getcwd() . '/src/App/PageType', true);
