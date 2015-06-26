<?php

namespace Uthmordar\Cardator\Card\lib;

class EntryPoint extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $actionApplication;
    protected $contentType;
    protected $encodingType;
    protected $httpMethod;
    protected $urlTemplate;
    protected $type = "http://schema.org/EntryPoint";

}
