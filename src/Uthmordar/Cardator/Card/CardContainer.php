<?php

namespace Uthmordar\Cardator\Card;

class CardContainer extends \SplObjectStorage{
    public function addCard(lib\iCard $card){        
        $this->attach($card);
        return $this;
    }
    
    public function getCards(){
        return $this;
    }
}