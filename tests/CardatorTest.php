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
    private $parser;
    
    public function setUp(){
        $this->parser=new Parser;
        $this->mockProcessor=$this->getMock('Uthmordar\Cardator\Card\CardProcessor', [], []);
        $this->mockParser=$this->getMock('Uthmordar\Cardator\Parser\Parser', [], []);
        $this->cardator=new Cardator(new CardGenerator, $this->mockProcessor, $this->parser);
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
        
        $this->mockParser->expects($this->exactly(2))->method('getCrawler')->willReturn($crawler);
        $this->mockParser->expects($this->exactly(1))->method('setGenericCard');
        $cardator=new Cardator(new CardGenerator, new CardProcessor, $this->mockParser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
        return $cardator;
    }
    
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Header error 404
     */
    public function testExceptionCrawl(){
        $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $cardator->crawl('http://test.tanguygodin.fr/404url.html');
        $this->assertEquals($cardator->getStatus(), 404);
    }
    
    /**
     * test generic card is set with no microdata
     */
    public function testGenericCard(){
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
        $card=$this->cardator->createCard('Thing');
        $this->parser->setGenericCard($card, $crawler);
        
        $this->assertEquals($card->name, 'Hello World!');
        $this->assertEquals($card->description, 'Title');
    }
    
    /**
     * test parser method call during crawling
     */
    public function testCrawlMicrodata(){
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
    

    /**
     * test data from crawl
     */
    public function testCrawlGlobal(){
        $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $cardator->crawl('http://test.tanguygodin.fr/test.html');
        $cards=$cardator->getCards(true);
        $this->assertTrue(is_string($cards));
        
        $this->assertTrue(is_int($cardator->getTotalCard()));
        $this->assertEquals($cardator->getTotalCard(), count($cardator->getCards()));
        $this->assertTrue(is_int($cardator->getStatus()));
        $this->assertTrue(is_float($cardator->getExecutionTime()));
        $this->assertTrue(is_array($cardator->getExecutionData()));
    }
}