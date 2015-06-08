<?php

namespace Uthmordar\Cardator\Card\lib;

class OrganizationRole extends Role{
    protected $parents="Thing\Intangible\Role";
    protected $numberedPosition;
    protected $type="http://schema.org/OrganizationRole";
}