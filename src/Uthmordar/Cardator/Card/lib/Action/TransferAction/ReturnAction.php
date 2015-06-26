<?php

namespace Uthmordar\Cardator\Card\lib;

class ReturnAction extends TransferAction {

    protected $parents = "Thing\Action\TransferAction";
    protected $recipient;
    protected $type = "http://schema.org/ReturnAction";

}
