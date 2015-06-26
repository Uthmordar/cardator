<?php

namespace Uthmordar\Cardator\Card\lib;

class Action extends Thing {

    protected $parents = "Thing";
    protected $actionStatus;
    protected $agent;
    protected $endTime;
    protected $error;
    protected $instrument;
    protected $location;
    protected $object;
    protected $participant;
    protected $result;
    protected $startTime;
    protected $target;
    protected $type = "http://schema.org/Action";

}
