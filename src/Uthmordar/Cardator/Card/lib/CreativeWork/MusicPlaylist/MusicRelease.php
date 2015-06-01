<?php

namespace Uthmordar\Cardator\Card\lib;

class MusicRelease extends MusicPlaylist{
    protected $parents="Thing\CreativeWork\MusicPlaylist";
    protected $catalogNumber;
    protected $creditedTo;
    protected $duration;
    protected $musicReleaseFormat;
    protected $recordLabel;
    protected $releaseOf;
    protected $type="http://schema.org/MusicRelease";
}