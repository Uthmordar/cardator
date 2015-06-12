<?php

namespace Uthmordar\Cardator\Parser;

use \Symfony\Component\DomCrawler\Crawler;
use \Uthmordar\Cardator\Card\lib\iCard;
use \Uthmordar\Cardator\Card\CardGenerator;

class MicroDataCrawler{
    /**
     * parse itemscope properties
     * 
     * @param Crawler $node
     * @param iCard $card
     */
    public static function getScopeContent(Crawler $node, iCard $card, $isItemref=false){
        $content=$node->html();
        $cr=new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card, $isItemref){
            self::setCardProperty($node, $card, $isItemref);
        });
    }
    
    /**     
     * get itemprop given value && set the couple in Card
     * 
     * @param Crawler $node
     * @param iCard $card
     * @return boolean
     */
    private static function setCardProperty(Crawler $node, iCard $card, $isItemref=false){
        $property=$node->attr('itemprop');
        if($node->parents()->attr('itemscope')!==null){return false;}
        if(self::nestedScope($node, $card, $property, $isItemref)){return true;}
        if(self::manageRawProperty($node, $property, $card)){return true;}
        if(self::manageImgProperty($node, $property, $card)){return true;}
        if(self::manageLinkProperty($node, $property, $card)){return true;}
        if(self::manageNumericProperty($node, $property, $card)){return true;}
        if(!$isItemref){$card->$property=trim($node->text());}
    }
    
    /**
     * get value if node as dk-raw attr
     * 
     * @param Crawler $node
     * @param type $prop
     * @param iCard $card
     * @return boolean
     */
    private static function manageRawProperty(Crawler $node, $prop, iCard $card){
        if($node->attr('dk-raw')){
            $card->$prop=$node->attr('dk-raw');
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
    private static function manageImgProperty(Crawler $node, $prop, iCard $card){
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
    private static function manageNumericProperty(Crawler $node, $prop, iCard $card){
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
    private static function manageLinkProperty(Crawler $node, $prop, iCard $card){
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
                   self::getScopeContent($node, $card, true); 
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
    private static function nestedScope(Crawler $node, iCard $card, $property, $isItemref){
        if($node->attr('itemscope')!==null){
            if($isItemref){
                $generator=new CardGenerator();
                try{
                    $type=self::getCardTypeFromCrawler($node);
                    $child=$generator->createCard($type);
                }catch(\RuntimeException $e){
                    $child=$generator->createCard('Thing');
                }
                
                $child->child=count($node->filter('[itemscope]'))-1;
                $child->url=$card->url;
                
                self::manageItemIdProperty($node, $child);
                self::getScopeContent($node, $child);
                
                $card->$property=$child;
                return true;
            }else{
                return self::updateChildList($card, $property);
            }
        }
    }
    
    /**
     * 
     * @param iCard $card
     * @param string $property
     * @return boolean
     */
    private static function updateChildList(iCard $card, $property){
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
    public static function getCardTypeFromCrawler(\Symfony\Component\DomCrawler\Crawler $node){
        $typeUrl=($node->attr('itemtype'))? $node->attr('itemtype') : 'Thing';
        $typeSplit=explode('/', $typeUrl);
        return array_pop($typeSplit);
    }
}