<?php

namespace Uthmordar\Cardator\Card\lib;

class EducationalOrganization extends Organization {

    protected $parents = "Thing\Organization";
    protected $alumni;
    protected $type = "http://schema.org/EducationalOrganization";

}
