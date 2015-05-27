<?php

namespace Uthmordar\Cardator\Card\lib;

class ListenAction extends ConsumeAction{
    protected $parents="Thing\Action\ConsumeAction";
    protected $type="http://schema.org/ListenAction";
}