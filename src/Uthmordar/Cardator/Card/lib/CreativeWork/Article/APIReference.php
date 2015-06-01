<?php

namespace Uthmordar\Cardator\Card\lib;

class APIReference extends TechArticle{
    protected $parents="Thing\CreativeWork\Article\TechArticle";
    protected $assemblyVersion;
    protected $executableLibraryName;
    protected $programmingModel;
    protected $targetPlatform;
    protected $type="http://schema.org/APIReference";
}