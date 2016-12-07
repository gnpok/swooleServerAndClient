<?php

define('BASEPATH', dirname(__FILE__));
require_once BASEPATH.'/TaskFactory.php';

class Server
{
    private $serv;

    public function __construct()
    {
        $allConfig = require_once BASEPATH.'/Config.php';
        $config = $allConfig['swoole']['server'];

        $this->serv = new swoole_server($config['host'], $config['port']);
        $this->serv->set(array(
            'daemonize' => $config['daemonize'],
            'dispatch_mode' => $config['dispatch_mode'],
            'task_worker_num' => $config['task_worker_num'],
            'task_ipc_mode' => $config['task_ipc_mode'],
            'log_file' => $config['log_file']
        ));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));
        // bind callback
        $this->serv->on('Task', array($this, 'onTask'));
        $this->serv->on('Finish', array($this, 'onFinish'));
        $this->serv->start();
    }


    public function onConnect($serv, $fd, $from_id)
    {
        echo "Client {$fd} connect\n";
    }

    public function onReceive(swoole_server $serv, $fd, $from_id, $data)
    {
        echo "Get Message From Client {$fd}:{$data}\n";
        // send a task to task worker.
        $data = json_decode($data,true);
        if(is_array($data) && isset($data['event'])){
            $serv->task($data);
            echo "Continue Handle Worker\n";
        }
       
    }

    /**
     *异步任务处理中心
     */
    public function onTask($serv, $task_id, $from_id, $data)
    {
        echo "This Task {$task_id} from Worker {$from_id}\n";
        TaskFactory::createTask($data);
    }

    public function onFinish($serv, $task_id, $data)
    {
        echo "Task {$task_id} finish\n";
        echo "Result: {$data}\n";
    }

    public function onClose($serv, $fd, $from_id)
    {
        echo "Client {$fd} close connection\n";
    }
}

$server = new Server();
