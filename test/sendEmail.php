<?php
/**
 * Created by PhpStorm.
 * User: gnp
 * Date: 2016/9/29
 * Time: 17:24
 */
require_once __DIR__.'/vendor/autoload.php';

$client = Client::getInstance();
$client->send([
    'event' => 'email',     //邮件事件
    'data' => [
        'to'    => 'email',
        'subject' => ' thinks for read',
        'body' => 'it is for test'
    ]
]);
