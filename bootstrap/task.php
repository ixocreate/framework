<?php
declare(strict_types=1);

/** @var TaskConfigurator $task */
use KiwiSuite\Scheduler\Task\TaskConfigurator;

$task->addDirectory(\getcwd() . '/src/App/Scheduler', true);