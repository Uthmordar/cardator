<?php

namespace Uthmordar\Cardator\Card\lib;

class OrderItem extends Intangible{
    protected $parents="Thing\Intangible";
    protected $orderDelivery;
    protected $orderItemNumber;
    protected $orderItemStatus;
    protected $orderQuantity;
    protected $orderedItem;
    protected $type="http://schema.org/OrderItem";
}