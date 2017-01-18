<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'swoole' => array(
        //swoole服务端配置
        'server' => array(
            'host' => '0.0.0.0',
            'port' => 9501,
            'daemonize' => false,
            'dispatch_mode' => 3,
            'task_worker_num' => 8,
            'task_ipc_mode' => 3,
            'log_file' => dirname(__FILE__) . '/swoole.log'
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