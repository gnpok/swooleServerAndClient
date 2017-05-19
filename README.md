### swoole简单的客户端，服务端异步工厂任务

#### 使用场景
> 在php-fpm模式下,php处理耗时比较长任务时，会发生堵塞，此时可以用异步方法，将该任务抛出，程序继续向下执行

> 在api接口场景下，可以使用我的另一个项目[yaf_api](https://github.com/gnpok/yafApi),同样支持异步任务，压测性比php-fpm高 


#### 基本使用 

1.php Server.php运行swoole服务端 

2.通过Client.php连接到服务端，并向服务端发送消息，进入异步任务
```
task中通过$data['event'] 来判断处理哪个事件，如发送邮件，短信发送等
```

