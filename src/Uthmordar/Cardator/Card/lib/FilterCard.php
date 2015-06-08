<?php

namespace Uthmordar\Cardator\Card\lib;

abstract class FilterCard{
    protected $filter=[
        'child'=>'noRegister',
        'childList'=>'noRegister',
        'dateCreated'=>'filterDateTime',
        'dateEdited'=>'filterDateTime',
        'datePublished'=>'filterDateTime',
        'dateModified'=>'filterDateTime',
        'birthDate'=>'filterDateTime',
        'deathDate'=>'filterDateTime',
        'foundingDate'=>'filterDateTime',
        'endDate'=>'filterDateTime',
        'startDate'=>'filterDateTime'];
  
    /**
     * search filter closure or function bind to a given property && apply it
     * 
     * @param string $name property 
     * @param string/DateTime $value property value
     * @return boolean
     */
    protected function filterValue($name, $value){
        if(!empty($this->filter[$name])){
            $filter=$this->filter[$name];
            if(is_callable($filter)){
                return $filter($name, $value);
            }
            return $this->$filter($name, $value);
        }
        $this->properties[]=$name;
        return false;
    }
    
    /**
     * 
     * @param string $name property 
     * @param string/DateTime $value property value
     * @return boolean
     */
    protected function noRegister($name, $value){
        return false;
    }
    
    /**
     * get value and return datetime
     * 
     * @param string $name property
     * @param \DateTime $value
     * @return \DateTime
     */
    protected function filterDateTime($name, $value){
        try{
            $val=new \DateTime($value);
        }catch(\Exception $e){
            $val=$value;
        }
        $this->properties[]=$name;
        return $val;
    }
     
    /**
     * add custom filter
     * 
     * @param string $name property
     * @param string or \Closure $filter ($name, $value)
     */
    protected function addFilter($name, $filter){
        $this->filter[$name]=$filter;
    }
    
    public function __sleep(){
        $this->filter=[];
        $keep=['type', 'child', 'childList', 'parents', 'params', 'properties'];
        foreach($this->properties as $p){
            if(isset($this->$p)){
                $keep[]=$p;
            }
        }
        return $keep;
    }
}