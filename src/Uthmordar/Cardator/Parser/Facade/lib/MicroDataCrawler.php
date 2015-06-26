<?php

namespace Uthmordar\Cardator\Parser\Facade\lib;

use \Symfony\Component\DomCrawler\Crawler;
use \Uthmordar\Cardator\Card\lib\CardInterface;
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
        if (self::$instance === null) {
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
    public function getScopeContent(Crawler $node, CardInterface $card, $isItemref = false) {
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
    private function setCardProperty(Crawler $node, CardInterface $card, $isItemref = false) {
        $property = $node->attr('itemprop');
        $nd = $node;
        if ($node->parents()->attr('itemscope') !== null) {
            return false;
        }
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
    private function manageRawProperty(Crawler $node, $prop, CardInterface $card) {
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
    private function manageImgProperty(Crawler $node, $prop, CardInterface $card) {
        $src = null;
        if ($node->attr('src')) {
            $src = $node->attr('src');
        }
        if ($node->attr('content')) {
            $src = $node->attr('content');
        }
        if ($src !== null) {
            $url = (is_array($card->url)) ? $card->url[0] : $card->url;
            $card->$prop = $this->getUri($src, $url);
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
    private function manageNumericProperty(Crawler $node, $prop, CardInterface $card) {
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
    private function manageLinkProperty(Crawler $node, $prop, CardInterface $card) {
        if ($node->attr('href')) {
            $href = $node->attr('href');
            $url = (is_array($card->url)) ? $card->url[0] : $card->url;
            $card->$prop = $this->getUri($href, $url);
            return true;
        }
    }

    /**
     * 
     * @param type $uri
     * @param type $current
     * @return type
     */
    protected function getUri($uri, $current) {

        if (null !== parse_url($uri, PHP_URL_SCHEME)) {
            return $uri;
        }

        if (!$uri) {
            return $current;
        }

        if ('#' === $uri[0]) {
            return $this->cleanupAnchor($current) . $uri;
        }

        $baseUri = $this->cleanupUri($current);

        if ('?' === $uri[0]) {
            return $baseUri . $uri;
        }

        if (0 === strpos($uri, '//')) {
            return preg_replace('#^([^/]*)//.*$#', '$1', $baseUri) . $uri;
        }

        $baseUri = preg_replace('#^(.*?//[^/]*)(?:\/.*)?$#', '$1', $baseUri);

        if ('/' === $uri[0]) {
            return $baseUri . $uri;
        }

        $path = parse_url(substr($current, strlen($baseUri)), PHP_URL_PATH);
        $path = $this->canonicalizePath(substr($path, 0, strrpos($path, '/')) . '/' . $uri);

        return $baseUri . ('' === $path || '/' !== $path[0] ? '/' : '') . $path;
    }

    /**
     * Returns the canonicalized URI path (see RFC 3986, section 5.2.4).
     *
     * @param string $path URI path
     * @return string
     */
    protected function canonicalizePath($path) {
        if ('' === $path || '/' === $path) {
            return $path;
        }

        if ('.' === substr($path, -1)) {
            $path .= '/';
        }

        $output = array();

        foreach (explode('/', $path) as $segment) {
            if ('..' === $segment) {
                array_pop($output);
            } elseif ('.' !== $segment) {
                $output[] = $segment;
            }
        }

        return implode('/', $output);
    }

    /**
     * Removes the query string and the anchor from the given uri.
     *
     * @param string $uri The uri to clean
     * @return string
     */
    protected function cleanupUri($uri) {
        return $this->cleanupQuery($this->cleanupAnchor($uri));
    }

    /**
     * Remove the query string from the uri.
     *
     * @param string $uri
     * @return string
     */
    protected function cleanupQuery($uri) {
        if (false !== $pos = strpos($uri, '?')) {
            return substr($uri, 0, $pos);
        }

        return $uri;
    }

    /**
     * Remove the anchor from the uri.
     *
     * @param string $uri
     * @return string
     */
    protected function cleanupAnchor($uri) {
        if (false !== $pos = strpos($uri, '#')) {
            return substr($uri, 0, $pos);
        }

        return $uri;
    }

    /**
     * get itemid prop value, itemid should be "def:propname:propvalue"
     * 
     * @param Crawler $node
     * @param \Uthmordar\Cardator\Card\lib\iCard $card
     * @return boolean
     */
    public function manageItemIdProperty(Crawler $node, CardInterface $card) {
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
    public function manageItemrefProperty(Crawler $node, CardInterface $card, Crawler $crawler) {
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
    private function nestedScope(Crawler $node, CardInterface $card, $property, $isItemref) {
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
    private function updateChildList(CardInterface $card, $property) {
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
