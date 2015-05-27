<?php

namespace Uthmordar\Cardator\Card\lib;

class ConsumeAction extends Action{
    protected $parents="Thing\Action";
    protected $expectsAcceptanceOf;
    protected $type="http://schema.org/ConsumeAction";
}