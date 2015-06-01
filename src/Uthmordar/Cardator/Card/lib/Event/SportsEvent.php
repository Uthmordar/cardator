<?php

namespace Uthmordar\Cardator\Card\lib;

class SportsEvent extends Event{
    protected $parents="Thing\Event";
    protected $awayTeam;
    protected $competitor;
    protected $homeTeam;
    protected $type="http://schema.org/SportsEvent";
}