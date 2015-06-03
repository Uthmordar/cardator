<?php

namespace Uthmordar\Cardator\Card\lib;

/**
 * default car class
 * regroup properties and access to them with __get, __set and __call
 */
class Thing extends FilterCard implements iCard{
    protected $child=0;
    protected $childList=[];
    protected $refId;
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
    protected $properties=[];
    protected $type="http://schema.org/Thing";
    
    protected $params=[];
    
    public function __construct(){
        $this->addFilter('child', function($name, $value){return false;});
    }
        
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
     * set card property or register it in params array if it doesn't exist
     * 
     * @param string $name
     * @param string || iCard || DateTime $value
     * @return \Uthmordar\Cardator\Card\lib\Thing
     */
    protected function setCardProperty($name, $value){
        $valF=$this->filterValue($name, $value);
        $val=($valF)? $valF : $value;
        if(property_exists($this, $name)){
            $this->$name=$val;
            return $this;
        }
        $this->params[$name]=$val;
        return $this;
    }
    
    /**
     * get card property if exists or get from params 
     * 
     * @param string $name
     * @return string || iCard 
     * @throws \RuntimeException
     */
    protected function getCardProperty($name){
        if(isset($this->$name)){
            return $this->$name;
        }
        if(array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        throw new \RuntimeException("Undefined property $name for {$this->getQualifiedName()}");
    }
      
    /**
     * get card type
     * 
     * @return string
     */
    public function getQualifiedName(){
        $reflect=new \ReflectionClass($this);
        return $reflect->getShortName();
    }
    
    /**
     * get an array of card parents
     * 
     * @return array
     */
    public function getParents(){
        return explode('\\',$this->parents);
    }
    
    /**
     * get direct parent name
     * 
     * @return string
     */
    public function getDirectParent(){
        $parent=get_parent_class($this);
        $reflect=new \ReflectionClass($parent);
        return $reflect->getShortName();
    }
}