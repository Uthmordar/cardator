<?php

namespace Uthmordar\Cardator\Parser;

interface iParser{
    public function setCrawler($url);
    public function getCrawler();
    public function getStatus();
    public function getCardType($elem);
    public function setCardProperties($elem, \Uthmordar\Cardator\Card\lib\iCard $card);
}