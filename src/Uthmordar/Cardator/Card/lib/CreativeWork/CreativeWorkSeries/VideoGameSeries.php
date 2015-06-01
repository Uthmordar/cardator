<?php

namespace Uthmordar\Cardator\Card\lib;

class VideoGameSeries extends CreativeWorkSeries{
    protected $parents="Thing\CreativeWork\CreativeWorkSeries";
    protected $actor;
    protected $characterAttribute;
    protected $cheatCode;
    protected $containsSeason;
    protected $director;
    protected $episode;
    protected $gameItem;
    protected $gameLocation;
    protected $gamePlatform;
    protected $musicBy;
    protected $numberOfEpisodes;
    protected $numberOfPlayers;
    protected $numberOfSeasons;
    protected $playMode;
    protected $productionCompany;
    protected $quest;
    protected $trailer;
    protected $type="http://schema.org/VideoGameSeries";
}