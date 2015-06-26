<?php

namespace Uthmordar\Cardator\Card\lib;

class SendAction extends TransferAction {

    protected $parents = "Thing\Action\TransferAction";
    protected $deliveryMethod;
    protected $recipient;
    protected $type = "http://schema.org/SendAction";

}
