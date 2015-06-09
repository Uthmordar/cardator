<?php

namespace Uthmordar\Cardator\Card\lib;

class FoodEstablishment extends LocalBusiness{
    protected $parents="Thing\Organization\LocalBusiness";
    protected $acceptsReservations;
    protected $menu;
    protected $servesCuisine;
    protected $type="http://schema.org/FoodEstablishment";
}