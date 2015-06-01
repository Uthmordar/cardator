<?php

namespace Uthmordar\Cardator\Card;

class CardProcessor extends CardContainer{
    protected $filter=[];
    private $except=[];
    private $only=[];
    
    /**
     * @param boolean $json true: result as json_encode, false: result as SPLObjectStorage collection
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getCards($json=false){
        if($json){
            return $this->formatCollectionToJson();
        }
        $collection=new CardCollection;
        foreach($this as $card){
            if($this->isAllowedType($card->getQualifiedName())){
                $collection->attach($card);
            }
        }
        return $collection;
    }
    
    /**
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getNonFilterCards(){
        $cards=[];
        foreach($this as $card){
            $cards[]=$card;
        }
        return $cards;
    }
    
    /**
     * 
     * @param cardQualifiedName or cardQualifiedName array $cardType if an array is provided then this array erase previous only array
     */
    public function addOnly($cardType){
        if(is_array($cardType)){
            $this->only=$cardType;
        }else{
            $this->only[]=$cardType;
        }
    }
    
    /**
     * 
     * @param cardQualifiedName or cardQualifiedName array $cardType if an array is provided then this array erase previous exception array
     */
    public function addExcept($cardType){
        if(is_array($cardType)){
            $this->except=$cardType;
        }else{
            $this->except[]=$cardType;
        }
    }
    
    /**
     * 
     * @param cardQualifiedName $type
     */
    private function isAllowedType($type){
        if(empty($this->only) && empty($this->except)){
            return $type;
        }else if(in_array($type, $this->except)){
            return false;
        }else if(in_array($type, $this->only)){
            return false;
        }
        return $type;
    }
    
    /**
     * add custom filter
     * 
     * @param string $name card property
     * @param \Closure $filter ($name, $value)
     */
    public function addPostProcessTreatment($name, \Closure $filter){
        $this->filter[$name]=$filter;
    }
    
    /**
     * run post processing procedure
     */
    public function doPostProcess(){
        foreach($this as $card){
            foreach($this->filter as $prop=>$closure){
                $this->applyFilterOnProperty($card, $prop, $closure);
            }
        }
    }
    
    /**
     * filter on property
     * 
     * @param iCard $card
     * @param string $prop property
     * @param Closure $closure
     * @return boolean
     */
    public function applyFilterOnProperty(lib\iCard $card, $prop, \Closure $closure){
        try{
            $card->$prop=$closure($prop, $card->$prop);
        }catch(\RuntimeException $e){
            return false;
        }
    }
    
    /**
     * 
     * @return json
     */
    private function formatCollectionToJson(){
        $data=[];
        foreach($this as $card){
            $k=$this->createArrayCard($card);
            $data[]=$k;
        }
        return json_encode($data);
    }
    
    /**
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return array
     */
    private function createArrayCard(lib\iCard $card){
        $array=[
            'type'=>$card->type,
            'class'=>$card->getQualifiedName()
        ];
        foreach($card->properties as $property){
            if($card->$property instanceof \DateTime){
                $array[$property]=$card->$property->getTimestamp();
                continue;
            }
            if($card->$property instanceof lib\iCard){
                $array[$property]=$this->createArrayCard($card->$property);
                continue;
            }
            $array[$property]=$card->$property;
        }
        return $array;
    }
}