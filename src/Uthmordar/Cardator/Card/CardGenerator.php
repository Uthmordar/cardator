<?php

namespace Uthmordar\Cardator\Card;

class CardGenerator implements iCardatorGenerator{
    private $card;
    private $libPath="\Uthmordar\Cardator\Card\lib\\";
    
    /**
     * 
     * @param type $type
     * @return type
     */
    public function createCard($type){
        $card= $this->libPath . ucfirst($type);
    
        $this->checkLib($card, $type);
        $this->card=new $card;

        return $this->card;
    }
    
    /**
     * 
     * @param type $className
     * @param type $type
     * @return boolean
     * @throws \RuntimeException
     */
    public function checkLib($className, $type){
        if(!class_exists($className)){
            throw new \RuntimeException("$type type card not found.");
        }
        return true;
    }
}