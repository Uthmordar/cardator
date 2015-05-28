<?php

namespace Uthmordar\Cardator\Card\lib;

class Thing implements iCard{
    protected $child=0;
    protected $childList=[];
    protected $parents;
    protected $additionalType;
    protected $alternateName;
    protected $potentialAction;
    protected $sameAs;
    protected $description;
    protected $image;
    protected $mainEntity;
    protected $name;
    protected $url;
    protected $type="http://schema.org/Thing";
    
    protected $params=[];
        
    public function __get($name){
        return $this->getCardProperty($name);
    }
    
    public function __set($name, $value){
       return $this->setCardProperty($name, $value);
    }
    
    public function __call($name, $arguments){
        if(!empty($arguments)){
            return $this->setCardProperty($name, $arguments[0]);
        }
        return $this->getCardProperty($name);
    }
    
    /**
     * 
     * @param type $name
     * @param type $value
     * @return \Uthmordar\Cardator\Card\lib\Thing
     */
    protected function setCardProperty($name, $value){
        if(property_exists($this, $name)){
            $this->$name=$value;
            return $this;
        }
        $this->params[$name]=$value;
        return $this;
    }
    
    /**
     * 
     * @param type $name
     * @return type
     * @throws \RuntimeException
     */
    protected function getCardProperty($name){
        if(isset($this->$name)){
            return $this->$name;
        }
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        throw new \RuntimeException("Undefined property $name for Thing");
    }
    
    /**
     * get card type
     * @return type
     */
    public function getCallifiedName(){
        $reflect=new \ReflectionClass($this);
        return $reflect->getShortName();
    }
}