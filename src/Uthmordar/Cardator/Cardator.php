<?php

namespace Uthmordar\Cardator;

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
    public function saveCard($card){
        $this->container->addCard($card);
    }
    
    public function crawl($url){
        $this->parser->setCrawler($url);
        $this->parser->getCrawler()->filter('[itemscope]')->each(function($node) use($url){
            $type=$this->getCardTypeFromParser($node);
            try{
                $card=$this->createCard($type);
            }catch(\RuntimeException $e){
                $card=$this->createCard('Thing');
            }
            $card->child=count($node->filter('[itemscope]'))-1;
            $card->url=$url;
            Parser\MicroDataCrawler::manageItemIdProperty($node, $card);
            Parser\MicroDataCrawler::getScopeContent($node, $card);
            $this->saveCard($card);
        });
    }
    
    public function getCardTypeFromParser($node){
        $typeUrl=($node->attr('itemtype'))? $node->attr('itemtype') : 'Thing';
        $typeSplit=explode('/', $typeUrl);
        return array_pop($typeSplit);
    }
}