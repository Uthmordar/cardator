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
    protected $onlyReplace=['child', 'childList', 'parents'];
    
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
            if(!empty($arguments[0]['replace']) && !empty($arguments[0]['replace'])==true){
                return $this->replaceCardProperty($name, $arguments[0]['filtered']);
            }
            return $this->setCardProperty($name, $arguments[0]);
        }
        return $this->getCardProperty($name);
    }
        
    /**
     * replace card property 
     * 
     * @param type $name property name
     * @param type $value 
     * @return \Uthmordar\Cardator\Card\lib\Thing
     */
    public function replaceCardProperty($name, $value){
        $cleanVal=(is_string($value))? htmlentities(utf8_decode($value)) : $value;
        if(property_exists($this, $name)){
            $this->$name=$cleanVal;
            return $this;
        }
        
        $this->params[$name]=$cleanVal;
        return $this;
    }
    
    /**
     * set card property or register it in params array
     * 
     * @param string $name
     * @param string || iCard || DateTime $value
     * @return \Uthmordar\Cardator\Card\lib\Thing
     */
    protected function setCardProperty($name, $value){
        $valF=$this->filterValue($name, $value);
        $val=($valF)? $valF : $value;
        $cleanVal=(is_string($val))? utf8_decode($val) : $val;
        if(property_exists($this, $name)){
            if(in_array($name, $this->onlyReplace)){
                $this->$name=$cleanVal;
            }else if(!is_array($this->$name) && !empty($this->$name)){
                $this->$name=[$this->$name, $cleanVal];
            }else if(is_array($this->$name)){
                array_push($this->$name, $cleanVal);
            }else{
                $this->$name=$cleanVal;
            }
            return $this;
        }
        
        $this->setCardParams($name, $cleanVal);
        return $this;
    }
    
    /**
     * set card property in params array
     * 
     * @param string $name
     * @param string || iCard || DateTime $val
     */
    protected function setCardParams($name, $val){
        if(!empty($this->params[$name]) && !is_array($this->params[$name])){
            $this->params[$name]=[$this->params[$name], $val];
        }else if(!empty($this->params[$name]) && is_array($this->params[$name])){
            array_push($this->params[$name], $val);
        }else{
            $this->params[$name]=$val;
        }
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
        return null;
        //throw new \RuntimeException("Undefined property $name for {$this->getQualifiedName()}");
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
        if(strpos($this->parents, '::')){
            $r=[];
            foreach(explode('::', $this->parents) as $p){
                $r[]=explode('\\',$p);
            }
            return $r;
        }
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