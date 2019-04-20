<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Translation\TranslationConfigurator;

/** @var TranslationConfigurator $translator */
$translator->addExtractDirectory(\getcwd() . '/templates');
$translator->addExtractDirectory(\getcwd() . '/src');

$translator->setExtractTarget(\getcwd() . '/resources/translation/extracted.json');
$translator->setDefaultCatalogue("web");
