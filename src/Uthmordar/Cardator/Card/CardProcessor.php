<?php

namespace Uthmordar\Cardator\Card;

class CardProcessor extends CardContainer{
    protected $filter=[
    ];
    private $except=[];
    private $only=[];
    
    /**
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getCards($json=false){
        if($json){
            return $this->formatCollectionToJson();
        }
        $collection=new CardCollection;
        foreach($this as $card){
            if($this->isAllowedType($card->getCallifiedName())){
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
     * @param type cardType or cardType array $cardType
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
     * @param type cardType or cardType array $cardType
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
     * @param type $type
     */
    private function isAllowedType($type){
        if((empty($this->only) && empty($this->except)) || (in_array($type, $this->only) && !in_array($type, $this->except))){
            return $type;
        }
        return false;
    }
    
    /**
     * add custom filter
     * @param type $name
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
     * @param type $card
     * @param type $prop
     * @param type $closure
     * @return boolean
     */
    public function applyFilterOnProperty($card, $prop, \Closure $closure){
        try{
            $card->$prop=$closure($prop, $card->$prop);
        }catch(\RuntimeException $e){
            return false;
        }
    }
    
    private function formatCollectionToJson(){
        $data=[];
        foreach($this as $card){
            $k=$this->createArrayCard($card);
            $data[]=$k;
        }
        return json_encode($data);
    }
    
    private function createArrayCard(lib\iCard $card){
        $array=[
            'type'=>$card->type,
            'class'=>$card->getCallifiedName()
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