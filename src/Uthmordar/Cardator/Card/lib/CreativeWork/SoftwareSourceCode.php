<?php

namespace Uthmordar\Cardator\Card\lib;

class SoftwareSourceCode extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $codeRepository;
    protected $codeSampleType;
    protected $programmingLanguage;
    protected $runtimePlatform;
    protected $targetProduct;
    protected $type="http://schema.org/SoftwareSourceCode";
}