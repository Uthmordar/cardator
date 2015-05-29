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
    public function getCards(){
        $cards=[];
        foreach($this as $card){
            if($this->isAllowedType($card->getCallifiedName())){
                $cards[]=$card;
            }
        }
        return $cards;
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
     * set output format: true => json, false => array of hydrated classes
     * @param \Uthmordar\Cardator\Boolean $val
     */
    public function setJson(Boolean $val){
        $this->json=$val;
    }
    
    /**
     * 
     * @param type $type
     */
    private function isAllowedType($type){
        if(in_array($type, $this->only) && !in_array($type, $this->except)){
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
     * 
     */
    public function doPostProcess(){
        foreach($this as $card){
            foreach($this->filter as $prop=>$closure){
                $this->applyFilterOnProperty($card, $prop, $closure);
            }
        }
    }
    
    public function applyFilterOnProperty($card, $prop, $closure){
        try{
            $card->$prop=$closure($prop, $card->$prop);
        }catch(\RuntimeException $e){
            return false;
        }
    }
}