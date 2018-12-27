<?php

namespace Ixocreate\Framework;

use Ixocreate\Cms\PageType\PageTypeConfigurator;

/** @var PageTypeConfigurator $pageType */

$pageType->addDirectory(getcwd() . '/src/App/PageType', true);
