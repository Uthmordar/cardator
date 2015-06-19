<?php

use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;

class FacadeTest extends \PHPUnit_Framework_TestCase {

    public function tearDown() {
        parent::tearDown();
    }

    /**
     * test facade instance
     */
    public function testInstace() {
        $this->assertInstanceOf('Uthmordar\Cardator\Parser\Facade\lib\MicroDataCrawler', MicroDataCrawler::newInstance());
    }

    /**
     * test facade give access to same instance
     */
    public function testSingleton() {
        $MD = MicroDataCrawler::newInstance();
        $this->assertEquals($MD, MicroDataCrawler::getInstance());
    }

}
