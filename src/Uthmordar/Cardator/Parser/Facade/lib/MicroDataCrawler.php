<?php

namespace Uthmordar\Cardator\Parser\Facade\lib;

use \Symfony\Component\DomCrawler\Crawler;
use \Uthmordar\Cardator\Card\lib\iCard;
use \Uthmordar\Cardator\Card\CardGenerator;

class MicroDataCrawler{
    private static $instance = null;
    private function __construct(){}
    
    private function __clone(){}

    public static function getInstance(){
        return self::$instance;
    }

    public static function newInstance(){
        if(self::$instance==null){
            self::$instance=new self();
        }
        return self::$instance;
    }
    /**
     * parse itemscope properties
     * 
     * @param Crawler $node
     * @param iCard $card
     */
    public function getScopeContent(Crawler $node, iCard $card, $isItemref=false){
        $content=$node->html();
        $cr=new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card, $isItemref){
            $this->setCardProperty($node, $card, $isItemref);
        });
    }
    
    /**     
     * get itemprop given value && set the couple in Card
     * 
     * @param Crawler $node
     * @param iCard $card
     * @return boolean
     */
    private function setCardProperty(Crawler $node, iCard $card, $isItemref=false){
        $property=$node->attr('itemprop');
        if($node->parents()->attr('itemscope')!==null){return false;}
        if($this->nestedScope($node, $card, $property, $isItemref)){var_dump('1');return true;}
        if($this->manageRawProperty($node, $property, $card)){return true;}
        if($this->manageImgProperty($node, $property, $card)){return true;}
        if($this->manageLinkProperty($node, $property, $card)){return true;}
        if($this->manageNumericProperty($node, $property, $card)){return true;}
        $card->$property=trim($node->text());
    }
    
    /**
     * get value if node as dk-raw attr or content attr
     * 
     * @param Crawler $node
     * @param type $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageRawProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('dk-raw')){
            $card->$prop=$node->attr('dk-raw');
            return true;
        }
        if($node->attr('content') && $prop!='image'){
            $card->$prop=$node->attr('content');
            return true;
        }
    }
    
    /**
     * get value if node is img tag
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageImgProperty(Crawler $node, $prop, iCard $card){
        $src=null;
        if($node->attr('src')){
            $src=$node->attr('src');
        }
        if($node->attr('content')){
            $src=$node->attr('content');
        }
        if($src!=null){
            $img=(!strpos($src, '/') && $card->url[strlen($card->url)-1]!=='/' && strrpos($card->url, '/')>8)? substr($card->url, 0, strrpos($card->url, '/')+1) . $src : $src;
            $card->$prop=($img[0]=='/')? $card->url . $img : $img;
            
            return true;
        }
    }
    
    /**
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageNumericProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('value')){
            $card->$prop=(float) $node->attr('value');
            return true;
        }
    }
    
    /**
     * get value if node is a tag
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageLinkProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('href')){
            $card->$prop=($node->attr('href')[0]=='/')? $card->url . $node->attr('href') : $node->attr('href');
            return true;
        }
    }
    
    /**
     * get itemid prop value
     * 
     * @param Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return boolean
     */
    public function manageItemIdProperty(Crawler $node, iCard $card){
        if($node->attr('itemid')){
            $id=$node->attr('itemid');
            $split=explode(':', $id);
            $card->$split[1]=$split[2];
            return true;
        }
    }
    
    /**
     * get itemid prop value
     * 
     * @param Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return boolean
     */
    public function manageItemrefProperty(Crawler $node, iCard $card, $crawler){
        if($node->attr('itemref')){
            $ids=explode(' ', $node->attr('itemref'));
            foreach($ids as $id){
                $crawler->filter('#'.trim($id))->each(function($node) use($card){
                    $this->getScopeContent($node, $card, true);
                });
            }
            return true;
        }
    }
    
    /**
     * get nested itemscope && register it in Card
     * 
     * @param Crawler $node
     * @param iCard $card
     * @param string $property
     * @return boolean
     */
    private function nestedScope(Crawler $node, iCard $card, $property, $isItemref){
        if($node->attr('itemscope')!==null){
            if($isItemref){
                $child=$this->subCardGeneration($node);
                $child->url=$card->url;
                
                $card->$property=$child;
                return true;
            }else{
                return $this->updateChildList($card, $property);
            }
        }
    }
    
    /**
     * create children Card from scope
     * 
     * @param Crawler $node
     * @return iCard
     */
    private function subCardGeneration(Crawler $node){
        $generator=new CardGenerator();
        try{
            $type=$this->getCardTypeFromCrawler($node);
            $child=$generator->createCard($type);
        }catch(\RuntimeException $e){
            $child=$generator->createCard('Thing');
        }

        $child->child=count($node->filter('[itemscope]'))-1;

        $this->manageItemIdProperty($node, $child);
        $this->getScopeContent($node, $child);
        
        return $child;
    }
    
    /**
     * 
     * @param iCard $card
     * @param string $property
     * @return boolean
     */
    private function updateChildList(iCard $card, $property){
        $data=$card->childList;
        array_push($data, $property);
        $card->childList=$data;
        return true;
    }
    
    /**
     * determine card type by itemtype or set default Thing type
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return string
     */
    public function getCardTypeFromCrawler(\Symfony\Component\DomCrawler\Crawler $node){
        $typeUrl=($node->attr('itemtype'))? $node->attr('itemtype') : 'Thing';
        $typeSplit=explode('/', $typeUrl);
        return array_pop($typeSplit);
    }
}