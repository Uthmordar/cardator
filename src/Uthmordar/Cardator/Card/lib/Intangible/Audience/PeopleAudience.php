<?php

namespace Uthmordar\Cardator\Card\lib;

class PeopleAudience extends Audience{
    protected $parents="Thing\Intangible\Audience";
    protected $healthCondition;
    protected $requiredGender;
    protected $requiredMaxAge;
    protected $requiredMinAge;
    protected $suggestedGender;
    protected $suggestedMaxAge;
    protected $suggestedMinAge;
    protected $type="http://schema.org/PeopleAudience";
}