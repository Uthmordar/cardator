<?php

namespace Uthmordar\Cardator\Card\lib;

class UpdateAction extends Action{
    protected $parents="Thing\Action";
    protected $targetCollection;
    protected $type="http://schema.org/UpdateAction";
}