<?php

class ParserTest extends \PHPUnit_Framework_TestCase{
    private $parser;
    
    public function setUp(){
        $this->parser=new \Uthmordar\Cardator\Parser\Parser;
    }

    public function tearDown() {
        parent::tearDown();
    }
        
    /**
     * test setting crawler for url
     * @return type
     */
    public function testSetCrawler(){
        $this->assertTrue($this->parser->setCrawler('http://google.fr') instanceof \Uthmordar\Cardator\Parser\Parser);
        $this->assertEquals($this->parser->getStatus(), 200);
        return $this->parser;
    }
    
    public function test404(){
        $this->parser->setCrawler('http://test.tanguygodin.fr/notfound.fr');
        $this->assertEquals($this->parser->getStatus(), 404);
    }
    
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid crawling url 
     */
    public function testSetCrawlerInvalidUrl(){
        $this->parser->setCrawler('invalid.url');
    }
    
    /**
     * test getCrawler return SymfonyDomCrawler instance
     * @depends testSetCrawler
     */
    public function testGetCrawler($parser){
        $this->assertTrue($parser->getCrawler() instanceof Symfony\Component\DomCrawler\Crawler);
    }
}