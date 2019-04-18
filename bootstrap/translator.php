<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

/** @var \Ixocreate\Translation\Package\Config\Configurator $translator */

$translator->addExtractDirectory(getcwd() . '/templates');
$translator->addExtractDirectory(getcwd() . '/src');

$translator->setExtractTarget(getcwd() . '/resources/translation/extracted.json');
$translator->setDefaultCatalogue("web");
