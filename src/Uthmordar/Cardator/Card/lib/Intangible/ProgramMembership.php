<?php

namespace Uthmordar\Cardator\Card\lib;

class ProgramMembership extends Intangible{
    protected $parents="Thing\Intangible";
    protected $hostingOrganization;
    protected $member;
    protected $membershipNumber;
    protected $programName;
    protected $type="http://schema.org/ProgramMembership";
}