<?php

namespace Uthmordar\Cardator\Card\lib;

class Dataset extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $datasetTimeInterval;
    protected $distribution;
    protected $includedDataCatalog;
    protected $spatial;
    protected $type="http://schema.org/Dataset";
}