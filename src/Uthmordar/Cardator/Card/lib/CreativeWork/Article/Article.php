<?php

namespace Uthmordar\Cardator\Card\lib;

class Article extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $articleBody;
    protected $articleSection;
    protected $pageEnd;
    protected $pageStart;
    protected $pagination;
    protected $wordCount;
    protected $type="http://schema.org/Article";
}