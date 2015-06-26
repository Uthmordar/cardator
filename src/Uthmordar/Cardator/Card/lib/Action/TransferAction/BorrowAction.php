<?php

namespace Uthmordar\Cardator\Card\lib;

class BorrowAction extends TransferAction {

    protected $parents = "Thing\Action\TransferAction";
    protected $lender;
    protected $type = "http://schema.org/BorrowAction";

}
