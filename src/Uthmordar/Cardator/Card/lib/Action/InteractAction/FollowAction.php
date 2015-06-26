<?php

namespace Uthmordar\Cardator\Card\lib;

class FollowAction extends InteractAction {

    protected $parents = "Thing\Action\InteractAction";
    protected $followee;
    protected $type = "http://schema.org/FollowAction";

}
