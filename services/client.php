<?php
class Client
{
    private $client;
    private static $instance;

    public function __construct() {
        $client = new swoole_client(SWOOLE_SOCK_TCP);
        $client->connect("127.0.0.1", 9501 , 1);
        if( !$client->isConnected() ) {
            return false;
        }
        $this->client = $client;
    }

    static public function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function send($eventData = []){

        return $this->client->send( json_encode($eventData) );
    }

}
$client = Client::getInstance();
