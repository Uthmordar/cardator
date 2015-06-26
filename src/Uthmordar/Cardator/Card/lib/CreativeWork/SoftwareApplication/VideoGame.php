<?php

namespace Uthmordar\Cardator\Card\lib;

class VideoGame extends SoftwareApplication {

    protected $parents = "Thing\CreativeWork\SoftwareApplication::Thing\CreativeWork\Game";
    protected $actor;
    protected $characterAttribute;
    protected $cheatCode;
    protected $director;
    protected $gameItem;
    protected $gameLocation;
    protected $gamePlatform;
    protected $gameServer;
    protected $gameTip;
    protected $musicBy;
    protected $numberOfPlayers;
    protected $playMode;
    protected $quest;
    protected $trailer;
    protected $type = "http://schema.org/VideoGame";

}
