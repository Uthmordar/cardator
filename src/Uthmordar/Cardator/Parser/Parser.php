<?php

namespace Uthmordar\Cardator\Parser;

use Goutte\Client;

class Parser implements iParser{
    private $client;
    private $crawler;
    
    public function __construct(){
        $this->client=new Client();
    }
    
    public function setCrawler($url){
        /*$fUrl=filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
        if(!$fUrl){
            throw new \RuntimeException('Invalid crawling url');
        }*/
        $this->crawler=$this->client->request('GET', $url);
        return $this;
    }
    
    public function getCrawler(){
        return $this->crawler;
    }
}