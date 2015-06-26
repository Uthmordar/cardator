<?php

namespace Uthmordar\Cardator\Card\lib;

class GiveAction extends TransferAction {

    protected $parents = "Thing\Action\TransferAction";
    protected $recipient;
    protected $type = "http://schema.org/GiveAction";

}
