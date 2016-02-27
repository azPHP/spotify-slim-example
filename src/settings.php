<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // Doctrine settings
        'doctrine' => [
            'connection' => [
                'driver' => 'pdo_sqlite',
                'path'   => __DIR__ . '/../data/album.sqlite'
            ],
            'metadata' => [
                'paths' => [],
                'proxy_dir' => __DIR__ . '/../data/proxies'
            ],
            'dev_mode' => true,
        ]
    ],
];
