<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Translation\Config\TranslationConfigurator;

/** @var TranslationConfigurator $translator */
$translator->addExtractDirectory(\getcwd() . '/templates');
$translator->addExtractDirectory(\getcwd() . '/src');

$translator->setExtractTarget(\getcwd() . '/resources/translation/extracted.json');
$translator->setDefaultCatalogue("web");
