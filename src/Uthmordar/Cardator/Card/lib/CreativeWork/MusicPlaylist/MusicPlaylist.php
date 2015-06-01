<?php

namespace Uthmordar\Cardator\Card\lib;

class MusicPlaylist extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $numbTracks;
    protected $track;
    protected $type="http://schema.org/MusicPlaylist";
}