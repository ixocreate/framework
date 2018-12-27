<?php
declare(strict_types=1);

/** @var TaskConfigurator $task */
use Ixocreate\Scheduler\Task\TaskConfigurator;

$task->addDirectory(\getcwd() . '/src/App/Scheduler', true);
