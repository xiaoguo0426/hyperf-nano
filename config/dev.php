<?php

declare(strict_types=1);

use Psr\Log\LogLevel;

return [
    'log_level' => [
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::DEBUG,
        LogLevel::EMERGENCY,
        LogLevel::ERROR,
        LogLevel::INFO,
        LogLevel::NOTICE,
        LogLevel::WARNING,
    ],

    'db.default' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'hyperf',
        'username' => 'homestead',
        'password' => 'secret',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => 'DB_PREFIX',
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => 60,
        ],
        'commands' => [
            'db:model' => [
                'path' => 'app/Model',
                'force_casts' => true,
                'inheritance' => 'Model',
            ],
        ],
    ],

    'crontab' => [
        //vendor/hyperf/crontab/src/Parser.php  详解
        '10-20/1 11-12 18 * * *' => [
            [new App\Crontab\Test, 'aaa'],
        ],
        '*/2 * * * * *' => [
//            [new App\Crontab\Test, 'bbb'],
        ],
        '*/5 * * * * *' => [
//            [new App\Crontab\Test, 'ccc'],
        ]
    ],

    'command' => [
        'echo' => [new App\Command\Test(), 'echo']
    ]

];
