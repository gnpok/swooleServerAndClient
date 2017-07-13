### swoole简单的客户端，服务端异步工厂任务

#### 使用场景
> 在php-fpm模式下,php处理耗时比较长任务时，会发生堵塞，此时可以用异步方法，将该任务抛出，程序继续向下执行

> 在api接口场景下，可以使用我的另一个项目[yaf_api](https://github.com/gnpok/yafApi),同样支持异步任务，压测性比php-fpm高 


#### 基本使用 
> 这里只是简单了使用异步任务，目的让大家可以通俗的理解swoole task使用

```
//1.开启服务端
php app/Server.php

//2.客户端链接服务端，并发送异步任务
新打开另一个终端
php app/Client.php
task中通过$data['event'] 来判断处理哪个事件，如发送邮件，短信发送等
```

