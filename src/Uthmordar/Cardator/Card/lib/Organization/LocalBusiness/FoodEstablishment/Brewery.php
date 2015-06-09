<?php

namespace Uthmordar\Cardator\Card\lib;

class Brewery extends FoodEstablishment{
    protected $parents="Thing\Organization\LocalBusiness\FoodEstablishment";
    protected $type="http://schema.org/Brewery";
}