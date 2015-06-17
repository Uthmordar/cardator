<?php

class FilterCardTest extends \PHPUnit_Framework_TestCase {

    private $card;

    public function setUp() {
        $this->card = new Uthmordar\Cardator\Card\lib\Thing;
    }

    public function tearDown() {
        parent::tearDown();
    }

    /**
     * test preprocessing filter for card
     */
    public function testFilterValue() {
        $this->card->child = 4;
        $this->card->dateCreated = '10-12-2010';
        $this->assertTrue($this->card->dateCreated instanceof \DateTime);
    }

    /**
     * test filter return if no valid DateTime given
     */
    public function testFilterDateTime() {
        $this->card->dateCreated = '10-12-2010 at 12pm';
        $this->assertFalse($this->card->dateCreated instanceof \DateTime);
        $this->assertEquals($this->card->dateCreated, '10-12-2010 at 12pm');
    }

    /**
     * test filter no register for child
     */
    public function testNoRegisterForChild() {
        $this->card->childList = 3;
        $this->assertTrue(!isset($this->card->properties['childList']));
    }

    /**
     * test sleep
     */
    public function testSerialize() {
        $this->card->url = 'test';
        $ser = serialize($this->card);
        $card = unserialize($ser);
        $this->assertEquals($card->url, $this->card->url);
    }

}
