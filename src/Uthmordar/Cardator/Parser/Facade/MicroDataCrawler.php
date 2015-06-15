<?php
namespace Uthmordar\Cardator\Parser\Facade;

class MicroDataCrawler extends SingletonFacade{    
    public static function getFacadeAccessor(){
        return 'MicroDataCrawler';
    }
}