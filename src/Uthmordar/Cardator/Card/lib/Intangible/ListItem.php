<?php

namespace Uthmordar\Cardator\Card\lib;

class ListItem extends Intangible{
    protected $parents="Thing\Intangible";
    protected $item;
    protected $nextItem;
    protected $position;
    protected $previousItem;
    protected $type="http://schema.org/ListItem";
}