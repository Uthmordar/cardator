<?php

namespace Uthmordar\Cardator\Card\lib;

class Clip extends CreativeWork {

    protected $parents = "Thing\CreativeWork";
    protected $actor;
    protected $clipNumber;
    protected $director;
    protected $musicBy;
    protected $partOfEpisode;
    protected $partOfSeason;
    protected $partOfSeries;
    protected $type = "http://schema.org/Clip";

}
