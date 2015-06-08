<?php

namespace Uthmordar\Cardator\Card\lib;

class SportsTeam extends SportsOrganization{
    protected $parents="Thing\Organization\SportsOrganization";
    protected $athlete;
    protected $coach;
    protected $type="http://schema.org/SportsTeam";
}