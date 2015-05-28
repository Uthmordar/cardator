<?php

namespace Uthmordar\Cardator\Card\lib;

class PlayAction extends Action{
    protected $parents="Thing\Action";
    protected $audience;
    protected $event;
    protected $type="http://schema.org/PlayAction";
}