<?php

use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Parser\Parser;


class CardatorTest extends \PHPUnit_Framework_TestCase{
    
    private $cardator;
    private $cardProcessor;
    
    public function setUp(){
        $this->cardProcessor=$this->getMock('Uthmordar\Cardator\Card\CardProcessor', [], []);
        $this->cardator=new Cardator(new CardGenerator, $this->cardProcessor, new Parser);
    }

    public function tearDown() {
        parent::tearDown();
    }
    
    /**
     * @test try to instantiate an unkown type of card
     * @expectedException RuntimeException
     * @expectedExceptionMessage Thing1 type card not found.
     */
    public function testUnknowType(){
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
     */
    public function testGetCards(){
        $this->cardProcessor->expects($this->exactly(1))->method('getCards');
        $this->cardator->getCards();
    }
    
    /**
     * test dependancy addOnly Processor from cardator
     */
    public function testAddOnly(){
        $this->cardProcessor->expects($this->exactly(1))->method('addOnly');
        $this->cardator->addOnly('Thing');
    }
    
    /**
     * test dependancy addExcept Processor from cardator
     */
    public function testAddExcept(){
        $this->cardProcessor->expects($this->exactly(1))->method('addExcept');
        $this->cardator->addExcept('Thing');
    }
    
    /**
     * test dependancy doPostProcess Processor from cardator
     */
    public function testDoPostProcess(){
        $this->cardProcessor->expects($this->exactly(1))->method('doPostProcess');
        $this->cardator->doPostProcess();
    }
    
    /**
     * test dependancy addPostProcessTreatment Processor from cardator
     */
    public function testAddPostProcessTreatment(){
        $this->cardProcessor->expects($this->exactly(1))->method('addPostProcessTreatment');
        $this->cardator->addPostProcessTreatment('test', function(){});
    }
    
    public function testCrawl(){
        $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
        $cards=$cardator->getCards(true);
        $this->assertTrue(is_string($cards));
    }
    
    public function testCrawlNoMicrodata(){
        $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $cardator->crawl('http://php.net');
        $cards=$cardator->getCards(true);
        $this->assertTrue(is_string($cards));
    }
}