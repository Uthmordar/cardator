<?php

use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardContainer;


class CardatorTest extends \PHPUnit_Framework_TestCase{
    
    private $cardator;
    
    public function setUp(){
        $this->cardator=new Cardator(new CardGenerator, new CardContainer);
    }

    public function tearDown() {
        parent::tearDown();
    }
     
    /**
     * @test try to instantiate an unkown type of card
     * @expectedException RuntimeException
     */
    public function testUnknowType(){
        $this->setExpectedException('RuntimeException', 'Thing1 type card not found.');
        $this->cardator->createCard('Thing1');
    }
    
    /**
     * check if given card implements iCard
     */
    public function testCardIsInstanceOfiCard(){
        $card=$this->cardator->createCard('Thing');
        $this->assertTrue($card instanceof \Uthmordar\Cardator\Card\lib\iCard);
        
        return $card;
    }
    
    /**
     * test cardator storage
     * @depends testCardIsInstanceOfiCard
     */
    public function testAddCard($card){
        $this->cardator->saveCard($card);
        return $this->cardator;
    }
    
    /**
     * test getting card from cardator
     * @depends testAddCard
     */
    public function testGetCards($cardator){
        $cards=$cardator->getCards();
        foreach($cards as $card){
            $this->assertTrue($card instanceof \Uthmordar\Cardator\Card\lib\iCard);
        }
    }
}