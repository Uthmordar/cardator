<?php

namespace Uthmordar\Cardator\Card\lib;

class RadioSeries extends CreativeWorkSeries {

    protected $parents = "Thing\CreativeWork\CreativeWorkSeries";
    protected $actor;
    protected $containsSeason;
    protected $director;
    protected $episode;
    protected $musicBy;
    protected $numberOfEpisodes;
    protected $numberOfSeasons;
    protected $productionCompany;
    protected $trailer;
    protected $type = "http://schema.org/RadioSeries";

}
