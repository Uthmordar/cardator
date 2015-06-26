<?php

namespace Uthmordar\Cardator\Card\lib;

class CommunicateAction extends InteractAction {

    protected $parents = "Thing\Action\InteractAction";
    protected $about;
    protected $inLanguage;
    protected $recipient;
    protected $type = "http://schema.org/CommunicateAction";

}
