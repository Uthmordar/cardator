<?php

namespace Uthmordar\Cardator\Card\lib;

class ImageObject extends MediaObject {

    protected $parents = "Thing\CreativeWork\MediaObject";
    protected $caption;
    protected $exifData;
    protected $representativeOfPage;
    protected $thumbnail;
    protected $type = "http://schema.org/ImageObject";

}
