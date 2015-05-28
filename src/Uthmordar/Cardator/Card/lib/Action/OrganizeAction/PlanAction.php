<?php

namespace Uthmordar\Cardator\Card\lib;

class PlanAction extends OrganizeAction{
    protected $parents="Thing\Action\OrganizeAction";
    protected $scheduledTime;
    protected $type="http://schema.org/PlanAction";
}