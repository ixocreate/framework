<?php
declare(strict_types=1);

namespace Ixocreate\Package\Admin;

/** @var MessageConfigurator $message */
use Ixocreate\Package\CommandBus\Message\MessageConfigurator;

$message->addDirectory( getcwd() . '/src/App/Message', true);
$message->addDirectory( getcwd() . '/src/Admin/Message', true);

