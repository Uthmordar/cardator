<?php

namespace Uthmordar\Cardator\Card\lib;

class Product extends Thing{
    protected $parents="Thing";
    protected $aggregateRating;
    protected $audience;
    protected $award;
    protected $brand;
    protected $category;
    protected $color;
    protected $depth;
    protected $gtin12;
    protected $gtin13;
    protected $gtin14;
    protected $gtin8;
    protected $height;
    protected $isAccessoryOrSparePartFor;
    protected $isConsumableFor;
    protected $isRelatedTo;
    protected $isSimilarTo;
    protected $itemCondition;
    protected $logo;
    protected $manufacturer;
    protected $model;
    protected $mpn;
    protected $type="http://schema.org/Product";
}