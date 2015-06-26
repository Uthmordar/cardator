<?php

namespace Uthmordar\Cardator\Card\lib;

class CreativeWorkSeason extends CreativeWork {

    protected $parents = "Thing\CreativeWork";
    protected $actor;
    protected $director;
    protected $endDate;
    protected $episode;
    protected $numberOfEpisodes;
    protected $partOfSeries;
    protected $productionCompany;
    protected $seasonNumber;
    protected $startDate;
    protected $trailer;
    protected $type = "http://schema.org/CreativeWorkSeason";

}
