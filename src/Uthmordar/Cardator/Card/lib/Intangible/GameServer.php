<?php

namespace Uthmordar\Cardator\Card\lib;

class GameServer extends Intangible{
    protected $parents="Thing\Intangible";
    protected $game;
    protected $playersOnline;
    protected $serverStatus;
    protected $type="http://schema.org/GameServer";
}