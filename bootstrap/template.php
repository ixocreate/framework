<?php
namespace KiwiSuite\Framework;

/** @var TemplateConfigurator $template */
use KiwiSuite\Asset\AssetExtension;
use KiwiSuite\Template\TemplateConfigurator;

$template->addExtension(AssetExtension::class);
// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');