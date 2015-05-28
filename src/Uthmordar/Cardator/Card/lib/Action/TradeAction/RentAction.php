<?php

namespace Uthmordar\Cardator\Card\lib;

class RentAction extends TradeAction{
    protected $parents="Thing\Action\TradeAction";
    protected $landlord;
    protected $realEstateAgent;
    protected $type="http://schema.org/RentAction";
}