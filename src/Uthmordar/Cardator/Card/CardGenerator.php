<?php

namespace Uthmordar\Cardator\Card;

/**
 * Allows instance card lib classes by class short name
 */
class CardGenerator implements iCardatorGenerator{
    private $card;
    private $libPath="\Uthmordar\Cardator\Card\lib\\";
    
    /**
     * set card from library by className
     * 
     * @param classQualifiedName $type
     * @return iCard
     */
    public function createCard($type){
        $card= $this->libPath . ucfirst($type);
    
        $this->checkClassExists($card, $type);
        $this->card=new $card;

        return $this->card;
    }
    
    /**
     * 
     * @param classQualifiedName $className
     * @param card type $type
     * @return boolean
     * @throws \RuntimeException
     */
    public function checkClassExists($className, $type){
        if(!class_exists($className)){
            throw new \RuntimeException("$type type card not found.");
        }
        return true;
    }
}