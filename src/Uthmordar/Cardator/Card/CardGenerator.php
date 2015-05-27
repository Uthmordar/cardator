<?php

namespace Uthmordar\Cardator\Card;

class CardGenerator{
    private $card;
    
    public function createCard($type){
        $card= "\Uthmordar\Cardator\Card\lib\\" . $type;
        $this->checkLib($card, $type);
        $this->card=new $card;
        
        return $this->card;
    }
    
    public function checkLib($className, $type){
        if(!class_exists($className)){
            throw new \RuntimeException("$type type card not found.");
        }
        return true;
    }
}