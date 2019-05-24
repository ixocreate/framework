<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Template\TemplateConfigurator;

/** @var TemplateConfigurator $template */

// ErrorHandler Templates
$template->addDirectory('error', \getcwd() . '/templates/error');
