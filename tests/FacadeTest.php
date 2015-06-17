<?php

use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;

class FacadeTest extends \PHPUnit_Framework_TestCase {

    public function tearDown() {
        parent::tearDown();
    }

    public function testInstace() {
        $this->assertInstanceOf('Uthmordar\Cardator\Parser\Facade\lib\MicroDataCrawler', MicroDataCrawler::newInstance());
    }

    public function testSingleton() {
        $MD = MicroDataCrawler::newInstance();
        $this->assertEquals($MD, MicroDataCrawler::getInstance());
    }

}
