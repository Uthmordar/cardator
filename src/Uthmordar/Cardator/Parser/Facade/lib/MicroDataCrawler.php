<?php

namespace Uthmordar\Cardator\Parser\Facade\lib;

use \Symfony\Component\DomCrawler\Crawler;
use \Uthmordar\Cardator\Card\lib\iCard;
use \Uthmordar\Cardator\Card\CardGenerator;

/**
 * regroup all crawling operations needed for microdata extraction
 */
class MicroDataCrawler {

    private static $instance = null;

    private function __construct() {
        
    }

    private function __clone() {}

    public static function getInstance() {
        return self::$instance;
    }

    public static function newInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * parse itemscope itemprop and hydrate given card
     * 
     * scope come from itemref, set isItemRef to true
     * 
     * @param Crawler $node
     * @param iCard $card
     * @param boolean $isItemref
     */
    public function getScopeContent(Crawler $node, iCard $card, $isItemref = false) {
        $content = $node->html();
        $cr = new Crawler($content);
        $cr->filter('[itemprop]')->each(function($node) use($card, $isItemref) {
            $this->setCardProperty($node, $card, $isItemref);
        });
    }

    /**
     * get itemprop given value && set the couple in Card
     * 
     * if isItemref is set to true, then only itemprop who have no direct itemscope parent in node will be recorded
     * 
     * @param Crawler $node
     * @param iCard $card
     * @param boolean $isItemref
     * @return boolean
     */
    private function setCardProperty(Crawler $node, iCard $card, $isItemref = false) {
        $property = $node->attr('itemprop');
        $nd = $node;
        if ($node->parents()->attr('itemscope') !== null) { return false; }
        if ($this->nestedScope($node, $card, $property, $isItemref)) { return true; }
        if ($this->manageRawProperty($node, $property, $card)) { return true; }
        if ($this->manageImgProperty($node, $property, $card)) { return true; }
        if ($this->manageLinkProperty($node, $property, $card)) { return true; }
        if ($this->manageNumericProperty($node, $property, $card)) { return true; }
        if ($isItemref) {
            while (count($nd)) {
                if ($nd->attr('itemscope') !== null) {
                    return true;
                }
                $nd = $nd->parents();
            }
        }
        $card->$property = trim($node->text());
    }

    /**
     * get value if node as dk-raw attr or content attr
     * 
     * @param Crawler $node
     * @param type $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageRawProperty(Crawler $node, $prop, iCard $card) {
        if ($node->attr('dk-raw')) {
            $card->$prop = $node->attr('dk-raw');
            return true;
        }
        if ($node->attr('content') && $prop != 'image') {
            $card->$prop = $node->attr('content');
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
    private function manageImgProperty(Crawler $node, $prop, iCard $card) {
        $src = null;
        if ($node->attr('src')) {
            $src = $node->attr('src');
        }
        if ($node->attr('content')) {
            $src = $node->attr('content');
        }
        if ($src != null) {
            $img = (!strpos($src, '/') && $card->url[strlen($card->url) - 1] !== '/' && strrpos($card->url, '/') > 8) ? substr($card->url, 0, strrpos($card->url, '/') + 1) . $src : $src;
            $card->$prop = ($img[0] == '/') ? $card->url . $img : $img;
            return true;
        }
    }

    /**
     * set value attr
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageNumericProperty(Crawler $node, $prop, iCard $card) {
        if ($node->attr('value')) {
            $card->$prop = floatval($node->attr('value'));
            return true;
        }
    }

    /**
     * get value if node is link tag
     * 
     * @param Crawler $node
     * @param string $prop
     * @param iCard $card
     * @return boolean
     */
    private function manageLinkProperty(Crawler $node, $prop, iCard $card) {
        if ($node->attr('href')) {
            $href = $node->attr('href');
            $link = (!strpos($href, '/') && $card->url[strlen($card->url) - 1] !== '/' && strrpos($card->url, '/') > 8) ? substr($card->url, 0, strrpos($card->url, '/') + 1) . $href : $href;
            $card->$prop = ($link[0] == '/') ? $card->url . $link : $link;
            return true;
        }
    }

    /**
     * get itemid prop value, itemid should be "def:propname:propvalue"
     * 
     * @param Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return boolean
     */
    public function manageItemIdProperty(Crawler $node, iCard $card) {
        if ($node->attr('itemid')) {
            $id = $node->attr('itemid');
            $split = explode(':', $id);
            $card->$split[1] = $split[2];
            return true;
        }
    }

    /**
     * get itemid prop value
     * 
     * third params is initial page node 
     * 
     * @param Crawler $node
     * @param iCard $card
     * @param Crawler $crawler
     * @return boolean
     */
    public function manageItemrefProperty(Crawler $node, iCard $card, $crawler) {
        if ($node->attr('itemref')) {
            $ids = explode(' ', $node->attr('itemref'));
            foreach ($ids as $id) {
                $crawler->filter('#' . trim($id))->each(function($node) use($card) {
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
     * @param boolean $isItemref
     * @return boolean
     */
    private function nestedScope(Crawler $node, iCard $card, $property, $isItemref) {
        if ($node->attr('itemscope') !== null) {
            if ($isItemref) {
                $child = $this->subCardGeneration($node, $card->url);

                $card->$property = $child;
                return true;
            } else {
                return $this->updateChildList($card, $property);
            }
        }
    }

    /**
     * create children Card from scope
     * 
     * @param Crawler $node
     * @param string url
     * @return iCard
     */
    private function subCardGeneration(Crawler $node, $url) {
        $generator = new CardGenerator();
        try {
            $type = $this->getCardTypeFromCrawler($node);
            $child = $generator->createCard($type);
        } catch (\RuntimeException $e) {
            $child = $generator->createCard('Thing');
        }
        $child->url = $url;
        $child->child = count($node->filter('[itemscope]')) - 1;

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
    private function updateChildList(iCard $card, $property) {
        $data = $card->childList;
        array_push($data, $property);
        $card->childList = $data;
        return true;
    }

    /**
     * determine card type by itemtype or set default Thing type
     * 
     * @param \Symfony\Component\DomCrawler\Crawler $node
     * @return string
     */
    public function getCardTypeFromCrawler(\Symfony\Component\DomCrawler\Crawler $node) {
        $typeUrl = ($node->attr('itemtype')) ? $node->attr('itemtype') : 'Thing';
        $typeSplit = explode('/', $typeUrl);
        return array_pop($typeSplit);
    }

}
