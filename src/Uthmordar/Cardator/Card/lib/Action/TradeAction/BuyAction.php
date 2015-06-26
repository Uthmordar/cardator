<?php

namespace Uthmordar\Cardator\Card\lib;

class BuyAction extends TradeAction {

    protected $parents = "Thing\Action\TradeAction";
    protected $seller;
    protected $type = "http://schema.org/BuyAction";

}
