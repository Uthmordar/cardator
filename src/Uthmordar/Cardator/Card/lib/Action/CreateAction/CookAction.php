<?php

namespace Uthmordar\Cardator\Card\lib;

class CookAction extends CreateAction{
    protected $parents="Thing\Action\CreateAction";
    protected $foodEstablishment;
    protected $foodEvent;
    protected $recipe;
    protected $type="http://schema.org/CookAction";
}