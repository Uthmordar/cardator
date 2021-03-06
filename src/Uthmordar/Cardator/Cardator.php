<?php

namespace Uthmordar\Cardator;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Coordinate all classes for the vendor and allows simple use of it
 */
class Cardator {

    private $generator;
    private $container;
    private $parser;
    private $totalCard;
    private $status;
    private $executionTime;
    public $childArray;

    public function __construct(Card\CardatorGeneratorInterface $generator, Card\CardatorContainerInterface $container, Parser\ParserInterface $parser) {
        $this->generator = $generator;
        $this->container = $container;
        $this->parser = $parser;
    }

    /**
     * given card Type will not be return in Cardator result
     * 
     * @param string cardType or cardType array $cardType
     */
    public function addExcept($cardType) {
        $this->container->addExcept($cardType);
    }

    /**
     * if only is use, only these card types will be return in Cardator result
     * 
     * @param string cardType or cardType array $cardType
     */
    public function addOnly($cardType) {
        $this->container->addOnly($cardType);
    }

    /**
     * get card from container, filter with only and except
     * 
     * @param boolean $json default=false, if set to true then json encode output else CardCollection
     * @return splObject containing all save cards
     */
    public function getCards($json = false) {
        return $this->container->getCards($json);
    }

    /**
     * get new card instance by type
     * 
     * @param string $type card qualified name
     * @return iCard
     */
    public function createCard($type) {
        return $this->generator->createCard($type);
    }

    /**
     * add a card to card container storage
     * 
     * @param iCard $card
     */
    public function saveCard(Card\lib\CardInterface $card) {
        $this->container->addCard($card);
    }

    /**
     * crawl given url && generate card from page content
     * 
     * @param string $url
     */
    public function crawl($url) {
        $start = microtime(true);
        $this->parser->setCrawler($url);
        $this->status = $this->parser->getStatus();
        if ((int) $this->parser->getStatus() > 399) {
            $this->setExecutionData($start);
            throw new \RuntimeException("Header error " . $this->parser->getStatus());
        }

        $scope = $this->parser->getCrawler()->filter('[itemscope]');
        if (count($scope)) {
            $this->setCardFromMD($scope, $url);
        } else {
            $this->setGenericCard($url);
        }

        $this->setExecutionData($start);
        $this->checkRelationship();
    }

    /**
     * create card from microdata && save it in cardContainer
     * 
     * @param Crawler $scope
     * @param string $url
     */
    private function setCardFromMD(Crawler $scope, $url) {
        $scope->each(function(Crawler $node) use($url) {
            try {
                $type = $this->parser->getCardType($node);
                $card = $this->createCard($type);
            } catch (\RuntimeException $e) {
                $card = $this->createCard('Thing');
            }
            if($node->attr('itemprop')){
                $this->childArray[]=$card;
            }
            $card->child = count($node->filter('[itemscope]')) - 1;
            $card->url = $url;

            $this->parser->setCardProperties($node, $card);

            $this->saveCard($card);
        });
    }

    /**
     * create card from no microdata page
     * 
     * @param string $url
     */
    private function setGenericCard($url) {
        $card = $this->createCard('Thing');
        $card->url = $url;
        $this->parser->setGenericCard($card, $this->parser->getCrawler());
        $this->saveCard($card);
    }

    /**
     * check if card has registered relationship
     */
    private function checkRelationship() {
        $cards = $this->container->getNonFilterCards();
        $i = 0;
        foreach ($cards as $card) {
            if ($card->childList) {
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
    private function setRelationship(Card\lib\CardInterface $card, $i, $cards) {
        $j = 1;
        $nbChild=count($card->childList);
        for ($k=0; $k<$nbChild; $k++){
            if(in_array($cards[$i + $j], $this->childArray)){
                $card->{$card->childList[$k]} = $cards[ $i + $j ];
                $j = ($cards[$i + $j]->child)? $j + $cards[$i + $j]->child : $j+1;
            }else{
                $k=$k-1;
                $j = ($cards[$i + $j]->child)? $j + $cards[$i + $j]->child : $j+1;
            }
        }
    }

    /**
     * register post process filtering on given properties
     * 
     * @param string $name card property
     * @param \Closure $closure filter to apply
     */
    public function addPostProcessTreatment($name, \Closure $closure) {
        $this->container->addPostProcessTreatment($name, $closure);
    }

    /**
     * run post processing operations
     */
    public function doPostProcess() {
        $this->container->doPostProcess();
    }

    /**
     * get number of card found in pages
     * @return int
     */
    public function getTotalCard() {
        return $this->totalCard;
    }
    
    /**
     * 
     * @param microtime $start
     */
    public function setExecutionData($start){
        $this->totalCard = count($this->getCards());
        $this->executionTime = microtime(true) - $start;
    }

    /**
     * get crawling execution time in s
     * @return float
     */
    public function getExecutionTime() {
        return $this->executionTime;
    }

    /**
     * get http response status for page crawled
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * get data relative to execution
     * @return array
     */
    public function getExecutionData() {
        return [
            'cards' => $this->totalCard,
            'executionTime' => $this->executionTime,
            'httpStatus' => $this->status
        ];
    }

}
