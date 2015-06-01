<?php

namespace Uthmordar\Cardator\Card\lib;

class MediaObject extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $associatedArticle;
    protected $bitrate;
    protected $contentSize;
    protected $contentUrl;
    protected $duration;
    protected $embedUrl;
    protected $encodesCreativeWork;
    protected $encodingFormat;
    protected $expires;
    protected $height;
    protected $playerTYpe;
    protected $productionCompany;
    protected $regionsAllowed;
    protected $requiresSubscription;
    protected $uploadDate;
    protected $width;
    protected $type="http://schema.org/MediaObject";
}