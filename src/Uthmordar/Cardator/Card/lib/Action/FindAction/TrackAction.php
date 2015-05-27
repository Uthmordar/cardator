<?php

namespace Uthmordar\Cardator\Card\lib;

class TrackAction extends FindAction{
    protected $parents="Thing\Action\FindAction";
    protected $deliveryMethod;
    protected $type="http://schema.org/TrackAction";
}