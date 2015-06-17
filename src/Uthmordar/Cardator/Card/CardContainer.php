<?php

namespace Uthmordar\Cardator\Card;

/**
 * SplObjectStorage and additional method to manage card
 */
abstract class CardContainer extends \SplObjectStorage implements iCardatorContainer{
    /**
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function addCard(lib\iCard $card){        
        $this->attach($card);
        return $this;
    }
    
    /**
     * @return \Uthmordar\Cardator\Card\CardContainer
     */
    public function getCards(){
        return $this;
    }
}