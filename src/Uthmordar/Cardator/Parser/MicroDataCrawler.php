<?php

namespace Uthmordar\Cardator\Parser;

use \Symfony\Component\DomCrawler\Crawler;

class MicroDataCrawler{
    /**
     * parse itemscope children
     * 
     * @param Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     */
    public static function getScopeContent(Crawler $node, \Uthmordar\Cardator\Card\lib\iCard $card){
        $content=$node->html();
        $cr=new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card){
            self::setCardProperty($node, $card);
        });
    }
    
    /**
     * get itemprop given value && set the couple in Card
     * 
     * @param type $node
     * @param type $card
     * @return boolean
     */
    private static function setCardProperty($node, $card){
        $property=$node->attr('itemprop');
        if($node->parents()->attr('itemscope')!==null){return false;}
        if(self::nestedScope($node, $card, $property)){return true;}
        if(self::manageImgProperty($node, $property, $card)){return true;}
        if(self::manageLinkProperty($node, $property, $card)){return true;}
        $card->$property=trim($node->text());
    }
    
    /**
     * get value if node is img tag
     * 
     * @param type $node
     * @param type $prop
     * @param type $card
     * @return boolean
     */
    private static function manageImgProperty($node, $prop, $card){
        if($node->attr('src')){
            $card->$prop=$node->attr('src');
            return true;
        }
    }
    
    /**
     * get value if node is a tag
     * 
     * @param type $node
     * @param type $prop
     * @param type $card
     * @return boolean
     */
    private static function manageLinkProperty($node, $prop, $card){
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
    public static function manageItemIdProperty(Crawler $node,  \Uthmordar\Cardator\Card\lib\iCard $card){
        if($node->attr('itemid')){
            $id=$node->attr('itemid');
            $split=explode(':', $id);
            $card->$split[1]=$split[2];
            return true;
        }
    }
    
    /**
     * get nested itemscope && register it in Card
     * 
     * @param type $node
     * @param type $card
     * @param type $property
     * @return boolean
     */
    private static function nestedScope($node, $card, $property){
        if($node->attr('itemscope')!==null){
            $data=$card->childList;
            array_push($data, $property);
            $card->childList=$data;
            return true;
        }
    }
}