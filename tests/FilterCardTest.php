<?php

class FilterCardTest extends \PHPUnit_Framework_TestCase{
    private $card;
    
    public function setUp(){
        $this->card=new Uthmordar\Cardator\Card\lib\Thing;
    }

    public function tearDown() {
        parent::tearDown();
    }
        
    public function testFilterValue(){
        $this->card->child=4;
        $this->card->dateCreated='10-12-2010';
        $this->assertTrue($this->card->dateCreated instanceof \DateTime);
    }
    
    public function testNoRegisterForChild(){
        $this->card->childList=3;
        $this->assertTrue(!isset($this->card->properties['childList']));
    }
}