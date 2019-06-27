<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Cms\PageType\PageTypeConfigurator;

/** @var PageTypeConfigurator $pageType */
$pageType->addDirectory(\getcwd() . '/src/App/PageType', true);
