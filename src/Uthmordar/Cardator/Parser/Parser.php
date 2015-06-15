<?php
namespace Uthmordar\Cardator\Parser;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;

class Parser implements iParser{
    private $client;
    private $crawler;
    
    public function __construct(){
        $this->client=new Client();
        /** allow https parsing */
        $guzzle=$this->client->getClient();
        $guzzle->setDefaultOption('verify', false);
        $this->client->setClient($guzzle);
    }
    
    /**
     * 
     * @param string $url
     * @return \Uthmordar\Cardator\Parser\Parser
     */
    public function setCrawler($url){
        $fUrl=filter_var($url, FILTER_VALIDATE_URL);
        if(!$fUrl){
            throw new \RuntimeException('Invalid crawling url');
        }
        $this->crawler=$this->client->request('GET', $url);
        return $this;
    }
    
    /**
     * 
     * @return Crawler
     */
    public function getCrawler(){
        return $this->crawler;
    }
    
    /**
     * get card type by crawling
     * 
     * @param Crawler $node
     * @return string Card type
     */
    public function getCardType($node){
        return MicroDataCrawler::getCardTypeFromCrawler($node);
    }
    
    /**
     * hydrate card by crawling dom
     * 
     * @param \Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     */
    public function setCardProperties($node, \Uthmordar\Cardator\Card\lib\iCard $card){
        MicroDataCrawler::manageItemIdProperty($node, $card);
        MicroDataCrawler::manageItemrefProperty($node, $card, $this->crawler);
        MicroDataCrawler::getScopeContent($node, $card);
    }
}