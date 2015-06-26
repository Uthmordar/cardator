<?php

namespace Uthmordar\Cardator\Card\lib;

class WinAction extends AchieveAction {

    protected $parents = "Thing\Action\AchieveAction";
    protected $loser;
    protected $type = "http://schema.org/WinAction";

}
