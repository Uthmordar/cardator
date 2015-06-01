<?php

namespace Uthmordar\Cardator\Card\lib;

class MusicRecording extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $byArtist;
    protected $duration;
    protected $inAlbum;
    protected $inPlaylist;
    protected $isrcCode;
    protected $recordingOf;
    protected $type="http://schema.org/MusicRecording";
}