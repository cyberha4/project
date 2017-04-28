<?php
use yii\helpers\ArrayHelper;

return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
