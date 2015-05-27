<?php

use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardContainer;


class CardTest extends \PHPUnit_Framework_TestCase{
    
    private $cardator;
    private $card;
    
    public function setUp(){
        $this->cardator=new Cardator(new CardGenerator, new CardContainer);
        $this->card=$this->cardator->createCard('Thing');
    }

    public function tearDown() {
        parent::tearDown();
    }
        
    /**
     * test if __set update property
     */
    public function testSetCardProperty(){
        $this->card->description="toto";
        $this->assertEquals($this->card->description, "toto");
    }
    
    /**
     * test if __set update params array 
     */
    public function testSetCardParams(){
        $this->card->notProperty="test";
        $this->assertEquals($this->card->notProperty, "test");
    }
    
    /**
     * test if __call update params/property && allows access to it
     */
    public function testCallCardParams(){
        $this->card->url('url');
        $this->card->notProperty('notProperty');
        $this->assertEquals($this->card->url(), "url");
        $this->assertEquals($this->card->notProperty(), "notProperty");
    }
    
    /**
     * test inexistant property or params
     * @expectedException RuntimeException
     */
    public function testGetUnknownParams(){
        $this->setExpectedException('RuntimeException', "Undefined property unknown for Thing");
        $this->card->unknown;
    }
}