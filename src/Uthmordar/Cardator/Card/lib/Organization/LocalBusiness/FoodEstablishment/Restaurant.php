<?php

namespace Uthmordar\Cardator\Card\lib;

class Restaurant extends FoodEstablishment {

    protected $parents = "Thing\Organization\LocalBusiness\FoodEstablishment";
    protected $type = "http://schema.org/Restaurant";

}
