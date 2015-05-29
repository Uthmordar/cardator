<?php

use Uthmordar\Cardator\Card\CardProcessor;

class CardContainerTest extends \PHPUnit_Framework_TestCase{
    
    private $container;
    private $mock;
    private $mock1;
    
    public function setUp(){
        $this->container=new CardProcessor;
        $this->mock=$this->getMock('Uthmordar\Cardator\Card\lib\Thing', array(), array());
        $this->mock1=$this->getMock('Uthmordar\Cardator\Card\lib\Thing', array(), array());
    }

    public function tearDown() {
        parent::tearDown();
    }
    
    /**
     * test card storage
     */
    public function testAddCard(){
        $this->container->addCard($this->mock);
        $this->container->addCard($this->mock1);
        return $this->container;
    }
    
    /**
     * test getting card from storage && expecting getting all card
     * @depends testAddCard
     */
    public function testGetCards($container){
        $cards=$container->getNonFilterCards();
        foreach($cards as $card){
            $this->assertTrue($card instanceof \Uthmordar\Cardator\Card\lib\iCard);
        }
        $this->assertEquals(2, count($cards));
    }
    
    /**
     * expect error if iCard is not implemented
     * @expectedException PHPUnit_Framework_Error
     */
    public function testNotACardGiven(){
        $this->assertFalse($this->container->addCard('toto'));
    }
}