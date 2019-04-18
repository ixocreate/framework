<?php
declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Template\TemplateConfigurator;

/** @var TemplateConfigurator $template */

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
