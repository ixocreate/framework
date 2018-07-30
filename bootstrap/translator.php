<?php
namespace KiwiSuite\Framework;
/** @var \KiwiSuite\Translation\Config\Configurator $translator */

$translator->addExtractDirectory(getcwd() . '/templates');
$translator->setExtractTarget(getcwd() . '/resources/translation/extracted.json');
$translator->setDefaultCatalogue("web");
