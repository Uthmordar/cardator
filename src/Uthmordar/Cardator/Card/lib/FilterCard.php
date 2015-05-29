<?php

namespace Uthmordar\Cardator\Card\lib;

abstract class FilterCard{
    protected $filter=[
        'child'=>'noRegister',
        'childList'=>'noRegister',
        'dateCreated'=>'filterDateTime',
        'dateEdited'=>'filterDateTime',
        'datePublished'=>'filterDateTime',
        'birthDate'=>'filterDateTime',
        'deathDate'=>'filterDateTime',
        'foundingDate'=>'filterDateTime'];
  
    protected function filterValue($name, $value){
        if(!empty($this->filter[$name])){
            $filter=$this->filter[$name];
            return $this->$filter($name, $value);
        }
        $this->properties[]=$name;
        return false;
    }
    
    protected function noRegister($name, $value){
        return false;
    }
    
    protected function filterDateTime($name, $value){
        $value=new \DateTime($value);
        $this->properties[]=$name;
        return $value;
    }
}