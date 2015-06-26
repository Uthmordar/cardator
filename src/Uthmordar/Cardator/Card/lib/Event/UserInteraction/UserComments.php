<?php

namespace Uthmordar\Cardator\Card\lib;

class UserComments extends UserInteraction {

    protected $parents = "Thing\Event\UserInteraction";
    protected $commentText;
    protected $commentTime;
    protected $creator;
    protected $discusses;
    protected $replyToUrl;
    protected $type = "http://schema.org/UserComments";

}
