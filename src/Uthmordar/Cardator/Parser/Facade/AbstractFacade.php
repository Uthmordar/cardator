<?php 
namespace Uthmordar\Cardator\Parser\Facade;

abstract class AbstractFacade{
    public static function __callStatic($method, $args){
        $instance=static::resolve(static::getFacadeAccessor());
        return call_user_func_array([$instance, $method],$args);
    }

    /*public static function resolve($name){
        $className = '\\Facade\\Library\\' . ucfirst($name);
        return new $className;
    }*/
}
