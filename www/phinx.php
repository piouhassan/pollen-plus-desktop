<?php

use AkConfig\App;

return [
    'paths' => [
        'migrations' => __DIR__ . "/database/migrations",
        "seeds" => __DIR__ . "/database/seeds"
    ],
    
    'environments' => [
        'default_database' => 'development',
        'development' => [
            "adapter" => "mysql",
            "host" => App::DB_HOST,
            "name" => App::DB_NAME,
            "user" => App::DB_USER,
            "pass" => App::DB_PASS,
            "port" => App::DB_PORT,
            "charset" => App::DB_CHARSET
        ]
    ]
];

