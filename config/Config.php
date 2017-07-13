<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

$config = array(
    'swoole' => array(
        //swoole服务端配置
        'server' => array(
            'host' => '0.0.0.0',
            'port' => 9501,
            'daemonize' => false,//是否开启守护进程
            'dispatch_mode' => 3,
            //'task_max_request' => 3,
            'task_worker_num' => 8,//开启task的个数，根据实际情况进行调整
            'task_ipc_mode' => 3,//设置task进程与worker进程之间通信的方式。1, 使用unix socket通信，默认模式；2, 使用消息队列通信；3, 使用消息队列通信，并设置为争抢模式
            'log_file' => LOG_PATH. '/swoole.log'//日志存放
        ),
        //swoole客户端配置
        'client' => array(
            'host' => '0.0.0.0.0',
            'port' => 9501
        )
    ),
    'email' => array(),
    'sms' => array()

);
return $config;