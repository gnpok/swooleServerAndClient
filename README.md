### swoole简单的客户端服务端异步工厂任务

>基本使用 

1.php Server.php运行swoole服务端 

2.通过Client.php连接到服务端，并向服务端发送消息，进入异步任务
```
task中通过$data['event'] 来判断处理哪个事件，如发送邮件，短信发送等
```

