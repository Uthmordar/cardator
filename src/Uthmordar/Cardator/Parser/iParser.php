<?php

namespace Uthmordar\Cardator\Parser;

interface iParser{
    public function setCrawler($url);
    public function getCrawler();
}