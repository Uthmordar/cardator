<?php

namespace Uthmordar\Cardator\Card\lib;

class ItemList extends Intangible{
    protected $parents="Thing\Intangible";
    protected $itemListElement;
    protected $itemListOrder;
    protected $numberOfItems;
    protected $type="http://schema.org/ItemList";
}