<?php

namespace Uthmordar\Cardator\Card\lib;

class ReplaceAction extends UpdateAction{
    protected $parents="Thing\Action\UpdateAction";
    protected $replacee;
    protected $replacer;
    protected $type="http://schema.org/ReplaceAction";
}