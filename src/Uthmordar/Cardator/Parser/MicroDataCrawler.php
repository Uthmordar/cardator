<?php

namespace Uthmordar\Cardator\Parser;

use \Symfony\Component\DomCrawler\Crawler;
use \Uthmordar\Cardator\Card\lib\iCard;

class MicroDataCrawler{
    /**
     * parse itemscope properties
     * 
     * @param Crawler $node
     * @param iCard $card
     */
    public static function getScopeContent(Crawler $node, iCard $card){
        $content=$node->html();
        $cr=new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card){
            self::setCardProperty($node, $card);
        });
    }
    
    /**     
     * get itemprop given value && set the couple in Card
     * 
     * @param Crawler $node
     * @param iCard $card
     * @return boolean
     */
    private static function setCardProperty(Crawler $node, iCard $card){
        $property=$node->attr('itemprop');
        if($node->parents()->attr('itemscope')!==null){return false;}
        if(self::nestedScope($node, $card, $property)){return true;}
        if(self::manageImgProperty($node, $property, $card)){return true;}
        if(self::manageLinkProperty($node, $property, $card)){return true;}
        if(self::manageNumericProperty($node, $property, $card)){return true;}
        $card->$property=trim($node->text());
    }
    
    /**
     * get value if node is img tag
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private static function manageImgProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('src')){
            $card->$prop=$node->attr('src');
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
    private static function manageNumericProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('value')){
            $card->$prop=$node->attr('value');
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
    private static function manageLinkProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('href')){
            $card->$prop=$node->attr('href');
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
    public static function manageItemIdProperty(Crawler $node, iCard $card){
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
    public static function manageItemrefProperty(Crawler $node, iCard $card, $crawler){
        if($node->attr('itemref')){
            $ids=explode(' ', $node->attr('itemref'));
            foreach($ids as $id){
                $crawler->filter('#'.trim($id))->each(function($node) use($card){
                   self::getScopeContent($node, $card); 
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
     * @param type $property
     * @return boolean
     */
    private static function nestedScope(Crawler $node, iCard $card, $property){
        if($node->attr('itemscope')!==null){
            $data=$card->childList;
            array_push($data, $property);
            $card->childList=$data;
            return true;
        }
    }
}