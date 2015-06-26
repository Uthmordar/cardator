<?php

namespace Uthmordar\Cardator\Card\lib;

class TipAction extends TradeAction {

    protected $parents = "Thing\Action\TradeAction";
    protected $recipient;
    protected $type = "http://schema.org/TipAction";

}
