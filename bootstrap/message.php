<?php
declare(strict_types=1);

namespace KiwiSuite\Admin;

/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $messageConfigurator */
use KiwiSuite\CommandBus\Message\MessageInterface;

$messageConfigurator->addDirectory( getcwd() . '/src/App/Admin/Message', true, [MessageInterface::class]);

