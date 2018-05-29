<?php

namespace KiwiSuite\Framework;

use KiwiSuite\Cms\PageType\PageTypeConfigurator;

/** @var PageTypeConfigurator $pageType */

$pageType->addDirectory(getcwd() . '/src/App/PageType', true);
