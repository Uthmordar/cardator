<?php

namespace Uthmordar\Cardator\Card\lib;

class Order extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $acceptedOffer;
    protected $billingAddress;
    protected $broker;
    protected $confirmationNumber;
    protected $customer;
    protected $discount;
    protected $discountCode;
    protected $discountCurrency;
    protected $isGift;
    protected $orderDate;
    protected $orderDelivery;
    protected $orderNumber;
    protected $orderStatus;
    protected $orderedItem;
    protected $partOfInvoice;
    protected $paymentDue;
    protected $paymentMethod;
    protected $paymentMethodId;
    protected $paymentUrl;
    protected $seller;
    protected $type = "http://schema.org/Order";

    public function __construct() {
        parent::__construct();
        $this->addFilter('orderDate', 'filterDateTime');
        $this->addFilter('paymentDue', 'filterDateTime');
    }

}
