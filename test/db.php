<?php

return [
    'default'     => 'local_mysql',
    'connections' => [
        'local_sqlite' => [
            // 数据库类型
            'type'     => 'sqlite',
            // 
            'dsn' => 'sqilte:/test.db',
            // 数据库名
            'database' => 'six',
            // 数据库编码默认采用utf8
            'charset'  => 'utf8mb4',
            // 数据库表前缀
            'prefix'   => 'six_',
            // 数据库调试模式
            'debug'    => true,
        ],
        'local_mysql' => [
            // 数据库类型
            'type'     => 'mysql',
            // 主机地址
            'hostname' => '127.0.0.1',
            // 用户名
            'username' => 'admin',
            // 密码
            'password' => 'admin',
            // 数据库名
            'database' => 'six',
            // 数据库编码默认采用utf8
            'charset'  => 'utf8mb4',
            // 数据库表前缀
            'prefix'   => 'six_',
            // 数据库调试模式
            'debug'    => true,
        ],
    ],
];
