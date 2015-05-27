<?php

use Uthmordar\Staticify\Page;
use Uthmordar\Staticify\Staticify;

class StaticityTest extends \PHPUnit_Framework_TestCase{
    
    private $page;
    private $mock;
    private $staticify;
    private $testFile;
    
    public function setUp(){
        $route="http://pagetest";
        $static="static.view";
        $this->page=new Page($route, $static);
        $this->mock=$this->getMock('Uthmordar\Staticify\Page', array(), array('http://pagetest', 'static.view'));
        $this->staticify=new Staticify();
        $this->testFile=__DIR__ . DIRECTORY_SEPARATOR . 'putContent.php';
    }

    public function tearDown() {
        parent::tearDown();
    }
	
     
    /**
     * @test page assessor
     */
    public function testPageData(){
        $this->assertFalse(!strrpos($this->page->getPage(), "pagetest"));
        $this->assertFalse(strrpos($this->page->getPage(), "page-test2"));
        
        $this->assertEquals('static.view', $this->page->getStatic());
    }
    
    
    /**
     * @test call generateStatic for each couple given
     * @expectedException RuntimeException
     */
    public function testGeneratePages(){
        $this->mock->expects($this->exactly(1))->method('getPage')->willReturn('http://pagetest');
        $this->mock->expects($this->exactly(1))->method('getStatic')->willReturn('static.view');
        $this->staticify->generateStatic($this->mock);
    }
    
    /**
     * @test get data from url fail
     * @expectedException RuntimeException
     */
    public function testExceptionWrongUrl(){
        $this->staticify->get_remote_data("test");
    }
    
    /**
     * @test call generateStatic for each couple given
     * @expectedException RuntimeException
     */
    public function testErrorNoFilePages(){
        $this->staticify->createView('test', 'content');
    }
    
    /**
     * @test call generateStatic for each couple given
     * @expectedException RuntimeException
     */
    public function testErrorNoContentPages(){
        $this->staticify->createView($this->testFile, false);
    }
    
    /**
     * @test put content in given file
     */
    public function testPutContent(){
        $rand=rand(1, 100);
        $this->staticify->createView($this->testFile, $rand);
        $content=file_get_contents($this->testFile);
        $this->assertEquals($rand, $content);
    }
    
    /**
     * @test success
     */
    /*public function testReturnTrueIfSuccess(){
        $this->assertTrue($this->staticify->generateStatic(new Page($this->testFile, $this->testFile)));
    }*/
}