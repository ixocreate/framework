<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Framework;

use Ixocreate\Event\Subscriber\SubscriberConfigurator;

/** @var SubscriberConfigurator $subscriber */
$subscriber->addDirectory(\getcwd() . '/src/App/Subscriber');
