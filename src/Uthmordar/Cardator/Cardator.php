<?php

namespace Uthmordar\Cardator;

use Uthmordar\Cardator\Parser\MicroDataCrawler;

class Cardator{
    private $generator;
    private $container;
    private $parser;
    private $json=false;
    
    public function __construct(Card\iCardatorGenerator $generator, Card\iCardatorContainer $container, Parser\iParser $parser){
        $this->generator=$generator;
        $this->container=$container;
        $this->parser=$parser;
    }
    
    /**
     * 
     * @param type cardType or cardType array $cardType
     */
    public function addExcept($cardType){
        $this->container->addExcept($cardType);
    }
    
    /**
     * 
     * @param type cardType or cardType array $cardType
     */
    public function addOnly($cardType){
        $this->container->addOnly($cardType);
    }
    
    /**
     * set output format: true => json, false => array of hydrated classes
     * @param \Uthmordar\Cardator\Boolean $val
     */
    public function setJson(Boolean $val){
        $this->json=$val;
    }
    
    /**
     * @return splObject containing all save cards
     */
    public function getCards(){
        return $this->container->getCards();
    }
    
    /**
     * get new card instance by type 
     * @param type $type
     * @return type
     */
    public function createCard($type){
        return $this->generator->createCard($type);
    }
    
    /**
     * add a card to card container storage
     * @param type $card
     */
    public function saveCard(Card\lib\iCard $card){
        $this->container->addCard($card);
    }
    
    /**
     * crawl given url && generate card from page content
     * @param type $url
     */
    public function crawl($url){
        $this->parser->setCrawler($url);
        $scope=$this->parser->getCrawler()->filter('[itemscope]');
        if($scope){
            $this->setCardFromMD($scope, $url);
        }else{
            $this->setGenericCard($url);
        }
        $this->checkRelationship();
    }
    
    /**
     * create card from microdata
     * @param type $scope
     * @param type $url
     */
    private function setCardFromMD($scope, $url){
        $scope->each(function($node) use($url){
            try{
                $type=$this->getCardTypeFromParser($node);
                $card=$this->createCard($type);
            }catch(\RuntimeException $e){
                $card=$this->createCard('Thing');
            }catch(\Exception $e){
                return false;
            }
            $card->child=count($node->filter('[itemscope]'))-1;
            $card->url=$url;
            
            MicroDataCrawler::manageItemIdProperty($node, $card);
            MicroDataCrawler::getScopeContent($node, $card);
            
            $this->saveCard($card);
        });
    }
    
    /**
     * create card from no microdata page
     * @param type $url
     */
    private function setGenericCard($url){
        $card=$this->createCard('Thing');
        $card->url=$url;
        /*
         * get some standard informations here
         * 
         */
        $this->saveCard($card);
    }
    
    /**
     * check if card has registered relationship
     */
    private function checkRelationship(){
        $cards=$this->container->getNonFilterCards();
        $i=0;
        foreach($cards as $card){
            if($card->childList){
                $this->setRelationship($card, $i, $cards);
            }
            $i++;
        }
    }
    
    /**
     * bind subcard to main card
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @param type $i
     * @param type $cards
     */
    private function setRelationship(Card\lib\iCard $card, $i, $cards){
        $j=1;
        foreach($card->childList as $prop){
            $card->$prop=$cards[$i+$j];
            $j=$j+$cards[$i+$j]->child;
        }
    }
    
    /**
     * determine card type by itemtype or set default Thing type
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return type
     */
    private function getCardTypeFromParser(\Symfony\Component\DomCrawler\Crawler $node){
        $typeUrl=($node->attr('itemtype'))? $node->attr('itemtype') : 'Thing';
        $typeSplit=explode('/', $typeUrl);
        return array_pop($typeSplit);
    }
    
    /**
     * 
     * @param type $name
     * @param \Closure $closure
     */
    public function addPostProcessTreatment($name, \Closure $closure){
        $this->container->addPostProcessTreatment($name, $closure);
    }
    
    /**
     * 
     */
    public function doPostProcess(){
        $this->container->doPostProcess();
    }
}