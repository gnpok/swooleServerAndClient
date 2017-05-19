<?php

/**
 * 自动加载
 */
class Autoload
{
    public static function _autoload($class = ''){
        $class_file = dirname(__FILE__).'/'.str_replace("\\", "/", $class).'.php';
        if(is_file($class_file)){
            require_once $class_file;
        }else{
            echo $class_file,"不存在";
            return true;
        }
    }
}

spl_autoload_register(array('Autoload','_autoload'));
//spl_autoload_register("Autoload::_autoload");