<?php

namespace Uthmordar\Cardator\Card\lib;

class VideoObject extends MediaObject {

    protected $parents = "Thing\CreativeWork\MediaObject";
    protected $actor;
    protected $captor;
    protected $director;
    protected $musicBy;
    protected $thumbnail;
    protected $transcript;
    protected $videoFrameSize;
    protected $videoQuality;
    protected $type = "http://schema.org/VideoObject";

}
