<?php

namespace Uthmordar\Cardator\Card\lib;

class MovieSeries extends CreativeWorkSeries{
    protected $parents="Thing\CreativeWork\CreativeWorkSeries";
    protected $actor;
    protected $director;
    protected $musicBy;
    protected $productionCompany;
    protected $trailer;
    protected $type="http://schema.org/MovieSeries";
}