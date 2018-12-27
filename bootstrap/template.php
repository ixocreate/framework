<?php
namespace Ixocreate\Framework;

/** @var TemplateConfigurator $template */
use Ixocreate\Template\TemplateConfigurator;

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
