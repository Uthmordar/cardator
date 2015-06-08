<?php

namespace Uthmordar\Cardator\Card\lib;

class Seat extends Intangible{
    protected $parents="Thing\Intangible";
    protected $seatNumber;
    protected $seatRow;
    protected $seatSection;
    protected $seatingType;
    protected $type="http://schema.org/Seat";
}