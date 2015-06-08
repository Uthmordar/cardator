<?php

namespace Uthmordar\Cardator\Card\lib;

class Invoice extends Intangible{
    protected $parents="Thing\Intangible";
    protected $accountId;
    protected $billingPeriod;
    protected $broker;
    protected $category;
    protected $confirmationNumber;
    protected $customer;
    protected $minimumPaymentDue;
    protected $paymentDue;
    protected $paymentMethod;
    protected $paymentMethodId;
    protected $paymentStatus;
    protected $provider;
    protected $referencesOrder;
    protected $scheduledPaymentDate;
    protected $totalPaymentDue;
    protected $type="http://schema.org/Invoice";
}