<?php

use Uthmordar\Staticify\PagesFactory;

class PagesTest extends \PHPUnit_Framework_TestCase{
    
    private $factory;
    
    
    public function setUp(){
        $this->factory=new PagesFactory();
    }

    public function tearDown() {
        parent::tearDown();
    }
     
    /**
     * test Page generation and storage in factory
     */
    public function testPagesStock(){
        $this->factory->addPage('route1', 'static1')->addPage('route2', 'static2');
        $this->assertEquals(2, count($this->factory));
        $i=1;
        foreach($this->factory as $page){
            $this->assertEquals($page->getPage(), 'route'.$i);
            $this->assertEquals($page->getStatic(), 'static'.$i);
            $i++;
        }
    }
    
    public function testAssessor(){
        $this->assertEquals($this->factory, $this->factory->getFactory());
    }
}