<?php

namespace Uthmordar\Cardator\Card\lib;

class WebPage extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $breadcrumb;
    protected $lastreviewed;
    protected $mainContentOfPage;
    protected $primaryImageOfPage;
    protected $relatedLink;
    protected $reviewedBy;
    protected $significantLink;
    protected $specialty;
    protected $type="http://schema.org/WebPage";
}