<?php

namespace Uthmordar\Cardator\Card\lib;

class SellAction extends TradeAction{
    protected $parents="Thing\Action\TradeAction";
    protected $buyer;
    protected $type="http://schema.org/SellAction";
}