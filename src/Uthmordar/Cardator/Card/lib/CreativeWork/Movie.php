<?php

namespace Uthmordar\Cardator\Card\lib;

class Movie extends CreativeWork {

    protected $parents = "Thing\CreativeWork";
    protected $actor;
    protected $director;
    protected $duration;
    protected $musicBy;
    protected $productionCompany;
    protected $subtitleLanguage;
    protected $trailer;
    protected $type = "http://schema.org/Movie";

}
