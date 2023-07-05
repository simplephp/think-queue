<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
    'default'     => 'database',
    'connections' => [
        'sync'     => [
            'type' => 'sync',
        ],
        'database' => [
            'type'       => 'database',
            'queue'      => 'default',
            'table'      => 'jobs',
            'connection' => null,
        ],
        'redis'    => [
            'type'       => 'redis',
            'queue'      => 'default',
            'host'       => '127.0.0.1',
            'port'       => 6379,
            'password'   => '',
            'select'     => 0,
            'timeout'    => 0,
            'persistent' => false,
        ],
        'rabbiMq'=>[
            'type' => 'rabbitMq',
            'dsn' => env('rabbitmq.dsn', null),
            'host' => env('rabbitmq.host', '192.168.13.213'),
            'port' => env('rabbitmq.port', 5672),
            'vhost' => env('rabbitmq.vhost', '/'),
            'login' => env('rabbitmq.login', 'admin'),
            'password' => env('rabbitmq.password', '123456'),
            'queue' => env('rabbitmq.queue', 'default'),
            'options' => [
                'exchange' => [
                    'name' => env('rabbitmq.exchange_name'),
                    /*
                    * Determine if exchange should be created if it does not exist.
                    */
                    'declare' => env('rabbitmq.exchange_declare', true),
                    /*
                    * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                    */
                    'type' => env('rabbitmq.exchange_type', \Interop\Amqp\AmqpTopic::TYPE_DIRECT),
                    'passive' => env('rabbitmq.exchange_passive', false),
                    'durable' => env('rabbitmq.exchange_durable', true),
                    'auto_delete' => env('rabbitmq.exchange_auto_delete', false),
                    'arguments' => env('rabbitmq.exchange_arguments'),
                ],

                'queue' => [
                    /*
                    * Determine if queue should be created if it does not exist.
                    */
                    'declare' => env('rabbitmq.queue_declare', true),
                    /*
                    * Determine if queue should be binded to the exchange created.
                    */
                    'bind' => env('rabbitmq.queue_bind', true),
                    /*
                    * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                    */
                    'passive' => env('rabbitmq.queue_passive', false),
                    'durable' => env('rabbitmq.queue_durable', true),
                    'exclusive' => env('rabbitmq.queue_exclusive', false),
                    'auto_delete' => env('rabbitmq.queue_auto_delete', false),
                    'arguments' => env('rabbitmq.queue_arguments'),
                ],
            ],

            /*
             * Determine the number of seconds to sleep if there's an error communicating with rabbitmq
             * If set to false, it'll throw an exception rather than doing the sleep for X seconds.
             */
            'sleep_on_error' => env('rabbitmq.sleep_on_error', 5),

            /*
             * Optional SSL params if an SSL connection is used
             */
            'ssl_params' => [
                'ssl_on' => env('rabbitmq.ssl', false),
                'cafile' => env('rabbitmq.ssl_cafile', null),
                'local_cert' => env('rabbitmq.ssl_local_cert', null),
                'local_key' => env('rabbitmq.ssl_local_key', null),
                'verify_peer' => env('rabbitmq.ssl_verify_peer', true),
                'passphrase' => env('rabbitmq.ssl_passphrase', null),
            ],
        ],
    ],
    'failed'      => [
        'type'  => 'none',
        'table' => 'failed_jobs',
    ],
];
