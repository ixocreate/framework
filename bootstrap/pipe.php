<?php
namespace KiwiSuite\Framework;

use KiwiSuite\Admin\Pipe\PipeConfigurator;
use KiwiSuite\Template\Middleware\TemplateMiddleware;

/** @var PipeConfigurator $pipe */
$pipe->pipe(TemplateMiddleware::class);
