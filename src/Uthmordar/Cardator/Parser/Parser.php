<?php

namespace Uthmordar\Cardator\Parser;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;
use Uthmordar\Cardator\Card\lib\iCard;

/**
 * allows page crawling with goutte client
 */
class Parser implements iParser {

    private $client;
    private $crawler;
    private $status;

    public function __construct() {
        $this->client = new Client();
        /** allow https parsing */
        $guzzle = $this->client->getClient();
        $guzzle->setDefaultOption('verify', false);
        $this->client->setClient($guzzle);
    }

    /**
     * 
     * @param string $url
     * @return \Uthmordar\Cardator\Parser\Parser
     */
    public function setCrawler($url) {
        $fUrl = filter_var($url, FILTER_VALIDATE_URL);
        if (!$fUrl) {
            throw new \RuntimeException('Invalid crawling url');
        }
        $this->crawler = $this->client->request('GET', $url);
        $this->status = $this->client->getResponse()->getStatus();
        return $this;
    }

    /**
     * 
     * @return http status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * 
     * @return Crawler
     */
    public function getCrawler() {
        return $this->crawler;
    }

    /**
     * get card type by crawling
     * 
     * @param Crawler $node
     * @return string Card type
     */
    public function getCardType($node) {
        return MicroDataCrawler::getCardTypeFromCrawler($node);
    }

    /**
     * hydrate card by crawling dom
     * 
     * @param Crawler $node
     * @param iCard $card
     */
    public function setCardProperties($node, iCard $card) {
        MicroDataCrawler::manageItemIdProperty($node, $card);
        MicroDataCrawler::manageItemrefProperty($node, $card, $this->crawler);
        MicroDataCrawler::getScopeContent($node, $card);
    }

    /**
     * hydrate card given with standard informations
     * 
     * @param iCard $card
     * @param Crawler $crawler
     */
    public function setGenericCard(iCard $card, Crawler $crawler) {
        $crawler->filter('h2')->each(function($node) use($card) {
            $card->name = trim($node->text());
        });
        $crawler->filter('title')->each(function($node) use($card) {
            $card->description = trim($node->text());
        });
    }

}
