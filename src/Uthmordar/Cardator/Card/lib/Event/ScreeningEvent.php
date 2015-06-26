<?php

namespace Uthmordar\Cardator\Card\lib;

class ScreeningEvent extends Event {

    protected $parents = "Thing\Event";
    protected $subtitleLanguage;
    protected $videoFormat;
    protected $workPresented;
    protected $type = "http://schema.org/ScreeningEvent";

}
