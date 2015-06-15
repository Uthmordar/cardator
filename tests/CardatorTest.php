<?php

use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Parser\Parser;

use Symfony\Component\DomCrawler\Crawler;

class CardatorTest extends \PHPUnit_Framework_TestCase{
    
    private $cardator;
    private $mockProcessor;
    private $mockParser;
    
    public function setUp(){
        $this->mockProcessor=$this->getMock('Uthmordar\Cardator\Card\CardProcessor', [], []);
        $this->mockParser=$this->getMock('Uthmordar\Cardator\Parser\Parser', [], []);
        $this->cardator=new Cardator(new CardGenerator, $this->mockProcessor, new Parser);
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
        $this->mockProcessor->expects($this->exactly(1))->method('getCards');
        $this->cardator->getCards();
    }
    
    /**
     * test dependancy addOnly Processor from cardator
     */
    public function testAddOnly(){
        $this->mockProcessor->expects($this->exactly(1))->method('addOnly');
        $this->cardator->addOnly('Thing');
    }
    
    /**
     * test dependancy addExcept Processor from cardator
     */
    public function testAddExcept(){
        $this->mockProcessor->expects($this->exactly(1))->method('addExcept');
        $this->cardator->addExcept('Thing');
    }
    
    /**
     * test dependancy doPostProcess Processor from cardator
     */
    public function testDoPostProcess(){
        $this->mockProcessor->expects($this->exactly(1))->method('doPostProcess');
        $this->cardator->doPostProcess();
    }
    
    /**
     * test dependancy addPostProcessTreatment Processor from cardator
     */
    public function testAddPostProcessTreatment(){
        $this->mockProcessor->expects($this->exactly(1))->method('addPostProcessTreatment');
        $this->cardator->addPostProcessTreatment('test', function(){});
    }
    
    /**
     * test html crawling is effectively call during crawling
     * @return Cardator
     */
    public function testCrawl(){
        $html ="<html>
            <head>
                <title>Title</title>
            </head>
            <body>
                <h2 class='message'>Hello World!</h2>
                <p>Hello Crawler!</p>
            </body>
        </html>";

        $crawler = new Crawler($html);
        
        $this->mockParser->expects($this->exactly(3))->method('getCrawler')->willReturn($crawler);
        $cardator=new Cardator(new CardGenerator, new CardProcessor, $this->mockParser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
        return $cardator;
    }
    
    /**
     * test generic card is set with no microdata
     * @depends testCrawl
     */
    public function testGenericCard($cardator){
        $cards=$cardator->getCards();
        foreach($cards as $card){
            $this->assertEquals($card->name, 'Hello World!');
            $this->assertEquals($card->description, 'Title');
        }
    }
    
    /**
     * test parser method call during crawling
     */
    /*public function testCrawlMicrodata(){
        $html ="<html>
            <body>
                <div itemscope itemtype='http://schema.org/Article'>
                    <h2 itemprop='name' class='message'>Hello World!</h2>
                    <p>Hello Crawler!</p>
                </div>
            </body>
        </html>";

        $crawler = new Crawler($html);
        
        $this->mockParser->expects($this->exactly(1))->method('getCrawler')->willReturn($crawler);
        $this->mockParser->expects($this->exactly(1))->method('getCardType')->willReturn('Article');
        $this->mockParser->expects($this->exactly(1))->method('setCardProperties');
        $cardator=new Cardator(new CardGenerator, new CardProcessor, $this->mockParser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
    }
    

    public function testCrawlGlobal(){
        $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
        $cards=$cardator->getCards(true);
        $this->assertTrue(is_string($cards));
    }*/
}