<?php
declare(strict_types=1);

namespace Ixocreate\Framework\Package;

use Ixocreate\Template\Package\TemplateConfigurator;

/** @var TemplateConfigurator $template */

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
