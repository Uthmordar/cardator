<?php

use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;
use Symfony\Component\DomCrawler\Crawler;
use Uthmordar\Cardator\Card\CardGenerator;

class MDCrawlerTest extends \PHPUnit_Framework_TestCase{
    
    private $MDCrawler;
    private $card;
    
    public function setUp(){
        $this->MDCrawler=MicroDataCrawler::newInstance();
        $cg=new CardGenerator;
        $this->card=$cg->createCard('Thing');
    }

    public function tearDown() {
        parent::tearDown();
    }
    
    /**
     * test get itemid property if attr itemid given
     */
    public function testItemid(){
        $html ="<div itemscope itemtype='http://schema.org/Thing'>
            </div>";

        $cr=new Crawler($html);

        $cr->filter('[itemscope]')->each(function($node){
            $this->assertNull($this->MDCrawler->manageItemIdProperty($node, $this->card));
        });
        
        $html ="<div itemscope itemtype='http://schema.org/Thing' itemid='bsn:isn:1023'>
            </div>";

        $cr=new Crawler($html);
        
        $cr->filter('[itemscope]')->each(function($node){
            $this->assertTrue($this->MDCrawler->manageItemIdProperty($node, $this->card));
        });
        $this->assertEquals($this->card->isn, 1023);
    }
    
    /**
     * test get itemid property if attr itemid given
     */
    public function testItemref(){
        $html ="<div itemscope itemtype='http://schema.org/Thing' itemref='b c'>
            </div>
            <div id='b'><span itemprop='name'>test_b</span></div>
            <div id='c'><span itemprop='description'>description</span></div>";

        $cr=new Crawler($html);

        $cr->filter('[itemscope]')->each(function($node) use ($cr){
            $this->assertTrue($this->MDCrawler->manageItemrefProperty($node, $this->card, $cr));
        });
        
        $this->assertEquals($this->card->name, 'test_b');
        $this->assertEquals($this->card->description, 'description');
    }
}