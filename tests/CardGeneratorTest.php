<?php

use Uthmordar\Cardator\Card\CardGenerator;

class CardGeneratorTest extends \PHPUnit_Framework_TestCase{
    
    private $generator;
    
    public function setUp(){
        $this->generator=new CardGenerator;
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
        $this->generator->createCard('Thing1');
    }
    
    /**
     * check if given card implements iCard
     */
    public function testCardIsInstanceOfiCard(){
        $card=$this->generator->createCard('Thing');
        $this->assertTrue($card instanceof \Uthmordar\Cardator\Card\lib\iCard);
    }
}