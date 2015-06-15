<?php 
namespace Uthmordar\Cardator\Parser\Facade;

abstract class SingletonFacade extends AbstractFacade{
    public static function resolve($name){
        $className = 'Uthmordar\\Cardator\\Parser\\Facade\\lib\\' . ucfirst($name);
        if($className::getInstance()){
            return $className::getInstance();
        }
        return $className::newInstance();
    }
}