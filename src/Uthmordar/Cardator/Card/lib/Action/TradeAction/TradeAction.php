<?php

namespace Uthmordar\Cardator\Card\lib;

class TradeAction extends Action{
    protected $parents="Thing\Action";
    protected $price;
    protected $priceSpecification;
    protected $type="http://schema.org/TradeAction";
}