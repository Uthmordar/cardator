<?php

namespace Uthmordar\Cardator\Parser;

use \Symfony\Component\DomCrawler\Crawler;

class MicroDataCrawler{
    public static function getScopeContent($node, \Uthmordar\Cardator\Card\lib\iCard $card){
        $content=$node->html();
        $cr=new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card){
            self::setCardProperty($node, $card);
        });
    }
    
    private static function setCardProperty($node, $card){
        $property=$node->attr('itemprop');
        if($node->parents()->attr('itemscope')!==null){return false;}
        if(self::nestedScope($node, $card, $property)){return true;}
        if(self::manageImgProperty($node, $property, $card)){return true;}
        if(self::manageLinkProperty($node, $property, $card)){return true;}
        $card->$property=trim($node->text());
    }
    
    private static function manageImgProperty($node, $prop, $card){
        if($node->attr('src')){
            $card->$prop=$node->attr('src');
            return true;
        }
    }
    
    private static function manageLinkProperty($node, $prop, $card){
        if($node->attr('href')){
            $card->$prop=$node->attr('href');
            return true;
        }
    }
    
    public static function manageItemIdProperty($node, $card){
        if($node->attr('itemid')){
            $id=$node->attr('itemid');
            $split=explode(':', $id);
            $card->$split[1]=$split[2];
            return true;
        }
    }
    
    private static function nestedScope($node, $card, $property){
        if($node->attr('itemscope')!==null){
            $data=$card->childList;
            array_push($data, $property);
            $card->childList=$data;
            return true;
        }
    }
}