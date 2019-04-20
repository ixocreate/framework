<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);
return [
    'migrations' => [
        'type' => 'local',
        'options' => [
            'root' => \getcwd() . '/resources/migrations',
        ],
    ],
];
