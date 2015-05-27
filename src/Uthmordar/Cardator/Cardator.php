<?php

namespace Uthmordar\Cardator;

class Cardator{
    private $generator;
    private $container;
    
    public function __construct(Card\iCardatorGenerator $generator, Card\iCardatorContainer $container){
        $this->generator=$generator;
        $this->container=$container;
    }
    
    /**
     * @return splObject containing all save cards
     */
    public function getCards(){
        return $this->container->getCards();
    }
    
    /**
     * get new card instance by type 
     * @param type $type
     * @return type
     */
    public function createCard($type){
        return $this->generator->createCard($type);
    }
    
    /**
     * add a card to card container storage
     * @param type $card
     */
    public function saveCard($card){
        $this->container->addCard($card);
    }
}