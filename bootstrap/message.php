<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var MessageConfigurator $message */
use KiwiSuite\CommandBus\Message\MessageConfigurator;

$message->addDirectory( getcwd() . '/src/App/Message', true);
$message->addDirectory( getcwd() . '/src/Admin/Message', true);

