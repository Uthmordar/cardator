<?php

namespace Uthmordar\Cardator\Card\lib;

class OrderAction extends TradeAction{
    protected $parents="Thing\Action\TradeAction";
    protected $deliveryMethod;
    protected $type="http://schema.org/OrderAction";
}