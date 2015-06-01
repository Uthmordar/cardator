<?php

namespace Uthmordar\Cardator\Card\lib;

class TechArticle extends Article{
    protected $parents="Thing\CreativeWork\Article";
    protected $dependencies;
    protected $proficiencyLevel;
    protected $type="http://schema.org/TechArticle";
}