<?php

namespace Uthmordar\Cardator\Card\lib;

class MoveAction extends Action {

    protected $parents = "Thing\Action";
    protected $fromLocation;
    protected $toLocation;
    protected $type = "http://schema.org/MoveAction";

}
