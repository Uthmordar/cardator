<?php

namespace Uthmordar\Cardator\Card\lib;

class LoseAction extends AchieveAction{
    protected $parents="Thing\Action\AchieveAction";
    protected $winner;
    protected $type="http://schema.org/LoseAction";
}