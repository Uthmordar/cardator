<?php

namespace Uthmordar\Cardator\Card\lib;

class ParentAudience extends PeopleAudience{
    protected $parents="Thing\Intangible\Audience\PeopleAudience";
    protected $childMaxAge;
    protected $childMinAge;
    protected $type="http://schema.org/ParentAudience";
}