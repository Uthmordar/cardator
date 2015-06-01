<?php

namespace Uthmordar\Cardator\Card\lib;

class Episode extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $actor;
    protected $director;
    protected $episodeNumber;
    protected $musicBy;
    protected $partOfSeason;
    protected $partOfSeries;
    protected $productionCompany;
    protected $trailer;
    protected $type="http://schema.org/Episode";
}