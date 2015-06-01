<?php

namespace Uthmordar\Cardator\Card\lib;

class PublicationVolume extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $pageEnd;
    protected $pageStart;
    protected $pagination;
    protected $volumeNumber;
    protected $type="http://schema.org/PublicationVolume";
}