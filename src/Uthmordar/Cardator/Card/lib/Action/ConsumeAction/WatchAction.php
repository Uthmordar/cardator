<?php

namespace Uthmordar\Cardator\Card\lib;

class WatchAction extends ConsumeAction{
    protected $parents="Thing\Action\ConsumeAction";
    protected $type="http://schema.org/WatchAction";
}