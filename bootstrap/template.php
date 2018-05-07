<?php
namespace KiwiSuite\Framework;

/** @var TemplateConfigurator $template */
use KiwiSuite\Template\TemplateConfigurator;

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
