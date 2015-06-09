<?php

namespace Uthmordar\Cardator\Card\lib;

class AccountingService extends FinancialService{
    protected $parents="Thing\Organization\LocalBusiness\FinancialService::Thing\Organization\LocalBusiness\ProfessionalService";
    protected $type="http://schema.org/AccountingService";
}