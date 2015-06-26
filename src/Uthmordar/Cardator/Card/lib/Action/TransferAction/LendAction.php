<?php

namespace Uthmordar\Cardator\Card\lib;

class LendAction extends TransferAction {

    protected $parents = "Thing\Action\TransferAction";
    protected $borrower;
    protected $type = "http://schema.org/LendAction";

}
