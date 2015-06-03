<?php

namespace Uthmordar\Cardator;

use Uthmordar\Cardator\Parser\MicroDataCrawler;

class Cardator{
    private $generator;
    private $container;
    private $parser;
    
    public function __construct(Card\iCardatorGenerator $generator, Card\iCardatorContainer $container, Parser\iParser $parser){
        $this->generator=$generator;
        $this->container=$container;
        $this->parser=$parser;
    }
    
    /**
     * 
     * @param string cardType or cardType array $cardType
     */
    public function addExcept($cardType){
        $this->container->addExcept($cardType);
    }
    
    /**
     * 
     * @param string cardType or cardType array $cardType
     */
    public function addOnly($cardType){
        $this->container->addOnly($cardType);
    }
        
    /**
     * @return splObject containing all save cards
     */
    public function getCards($json=false){
        return $this->container->getCards($json);
    }
    
    /**
     * get new card instance by type
     * 
     * @param string $type card qualified name
     * @return type
     */
    public function createCard($type){
        return $this->generator->createCard($type);
    }
    
    /**
     * add a card to card container storage
     * 
     * @param iCard $card
     */
    public function saveCard(Card\lib\iCard $card){
        $this->container->addCard($card);
    }
    
    /**
     * crawl given url && generate card from page content
     * 
     * @param string $url
     */
    public function crawl($url){
        $this->parser->setCrawler($url);
        $scope=$this->parser->getCrawler()->filter('[itemscope]');
        if(count($scope)){
            $this->setCardFromMD($scope, $url);
        }else{
            $this->setGenericCard($url);
        }
        $this->checkRelationship();
    }
    
    /**
     * create card from microdata
     * 
     * @param Crawler $scope
     * @param string $url
     */
    private function setCardFromMD($scope, $url){
        $scope->each(function($node) use($url){
            try{
                $type=MicroDataCrawler::getCardTypeFromCrawler($node);
                $card=$this->createCard($type);
            }catch(\RuntimeException $e){
                $card=$this->createCard('Thing');
            }
            $card->child=count($node->filter('[itemscope]'))-1;
            $card->url=$url;
            
            MicroDataCrawler::manageItemIdProperty($node, $card);
            MicroDataCrawler::manageItemrefProperty($node, $card, $this->parser->getCrawler());
            MicroDataCrawler::getScopeContent($node, $card);
            
            $this->saveCard($card);
        });
    }
    
    /**
     * create card from no microdata page
     * 
     * @param string $url
     */
    private function setGenericCard($url){
        $card=$this->createCard('Thing');
        $card->url=$url;
        $this->parser->getCrawler()->filter('h2')->each(function($node) use($card){
           $card->name=trim($node->text()); 
        });
        $this->parser->getCrawler()->filter('title')->each(function($node) use($card){
           $card->description=trim($node->text()); 
        });
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
     * 
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @param number $i
     * @param array $cards
     */
    private function setRelationship(Card\lib\iCard $card, $i, $cards){
        $j=1;
        foreach($card->childList as $prop){
            $card->$prop=$cards[$i+$j];
            $j=$j+$cards[$i+$j]->child;
        }
    }
    
    /**
     * 
     * @param string $name card property
     * @param \Closure $closure
     */
    public function addPostProcessTreatment($name, \Closure $closure){
        $this->container->addPostProcessTreatment($name, $closure);
    }
    
    /**
     * run post processing operations
     */
    public function doPostProcess(){
        $this->container->doPostProcess();
    }
}