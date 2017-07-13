<?php
namespace task;
class Sample implements TaskInterface
{

    public static function doTask($data = array())
    {
        sleep(3);//为了直接看效果，这边暂停3秒
    	echo "it is ok";
    }
}
