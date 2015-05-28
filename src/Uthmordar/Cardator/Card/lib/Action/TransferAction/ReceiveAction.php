<?php

namespace Uthmordar\Cardator\Card\lib;

class ReceiveAction extends TransferAction{
    protected $parents="Thing\Action\TransferAction";
    protected $deliveryMethod;
    protected $sender;
    protected $type="http://schema.org/ReceiveAction";
}