<?php

namespace Uthmordar\Cardator\Card\lib;

class NewsArticle extends Article {

    protected $parents = "Thing\CreativeWork\Article";
    protected $dateline;
    protected $printColumn;
    protected $printEdition;
    protected $printPage;
    protected $printSection;
    protected $type = "http://schema.org/NewsArticle";

}
