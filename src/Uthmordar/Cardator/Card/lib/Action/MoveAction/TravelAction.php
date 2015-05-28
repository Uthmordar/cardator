<?php

namespace Uthmordar\Cardator\Card\lib;

class TravelAction extends MoveAction{
    protected $parents="Thing\Action\MoveAction";
    protected $distance;
    protected $type="http://schema.org/TravelAction";
}