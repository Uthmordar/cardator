<?php

namespace Uthmordar\Cardator\Card\lib;

class WriteAction extends CreateAction{
    protected $parents="Thing\Action\CreateAction";
    protected $inLanguage;
    protected $type="http://schema.org/WriteAction";
}