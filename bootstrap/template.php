<?php
declare(strict_types=1);

namespace Ixocreate\Package\Framework;

use Ixocreate\Package\Template\TemplateConfigurator;

/** @var TemplateConfigurator $template */

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
