<?php

namespace Uthmordar\Cardator\Card\lib;

class MusicAlbum extends MusicPlaylist{
    protected $parents="Thing\CreativeWork\MusicPlaylist";
    protected $albumProductionType;
    protected $albumRelease;
    protected $albumReleaseType;
    protected $byArtist;
    protected $type="http://schema.org/MusicAlbum";
}