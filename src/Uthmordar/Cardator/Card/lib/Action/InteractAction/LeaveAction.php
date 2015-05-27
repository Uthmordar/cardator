<?php

namespace Uthmordar\Cardator\Card\lib;

class LeaveAction extends InteractAction{
    protected $parents="Thing\Action\InteractAction";
    protected $event;
    protected $type="http://schema.org/LeaveAction";
}