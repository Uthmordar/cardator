<?php

use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Parser\Parser;


class CardTest extends \PHPUnit_Framework_TestCase{
    
    private $cardator;
    private $card;
    private $article;
    
    public function setUp(){
        $this->cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
        $this->card=$this->cardator->createCard('Thing');
        $this->article=$this->cardator->createCard('Article');
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
    
    public function testReplaceCardProperty(){
        $this->card->name('name');
        $this->card->replaceCardProperty('name', 'replacement');
        $this->assertEquals($this->card->name, "replacement");
    }
    
    /**
     * test inexistant property or params
     * @expectedException RuntimeException
     * @expectedExceptionMessage Undefined property unknown for Thing
     */
    public function testGetUnknownParams(){
        $this->card->unknown;
    }
    
    /**
     * test card type value access
     */
    public function testCallifiedName(){
        $this->assertEquals('Thing', $this->card->getQualifiedName());
    }
    
    /**
     * test get card parents
     */
    public function testGetParents(){
        $this->assertEquals(['Thing', 'CreativeWork'], $this->article->getParents());
        $this->article->parents='Thing\Test::Thing\TestBis';
        $this->assertEquals([['Thing', 'Test'], ['Thing', 'TestBis']], $this->article->getParents());
    }
    
    /**
     * test get only direct parent name
     */
    public function testGetDirectParent(){
        $this->assertEquals('CreativeWork', $this->article->getDirectParent());
    }
}