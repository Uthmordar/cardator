<?php

namespace Uthmordar\Cardator\Card\lib;

class PayAction extends TradeAction{
    protected $parents="Thing\Action\TradeAction";
    protected $purpose;
    protected $recipient;
    protected $type="http://schema.org/PayAction";
}