<?php

/**
 *同步客户端用于php-fpm模式下
 */
class Client
{
    private $client;
    private static $instance;

    public function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
        $fp = $this->client->connect("0.0.0.0", 9501, 1);
        if (!$fp) {
            echo "Error: {$fp->errMsg}[{$fp->errCode}]\n";
            return false;
        }
    }

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendMsg($data = array())
    {
        if (!is_array($data)) {
            return false;
        }
        //这边send只能send字符串
        return $this->client->send(json_encode($data));
    }
}

//使用示例
$client = Client::getInstance();
$data = array(
    'time' => time(),
    'event' => 'sample'
);
$res = $client->sendMsg($data);
var_dump($res);//发送成功返回int数据，立即返回，这边并没有堵塞
echo "go on";