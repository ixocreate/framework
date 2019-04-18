<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

/** @var \Ixocreate\Package\Translation\Config\Configurator $translator */

$translator->addExtractDirectory(getcwd() . '/templates');
$translator->addExtractDirectory(getcwd() . '/src');

$translator->setExtractTarget(getcwd() . '/resources/translation/extracted.json');
$translator->setDefaultCatalogue("web");
