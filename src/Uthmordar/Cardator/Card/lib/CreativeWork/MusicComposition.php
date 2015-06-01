<?php

namespace Uthmordar\Cardator\Card\lib;

class MusicComposition extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $composer;
    protected $firstPerformance;
    protected $includedComposition;
    protected $iswcCode;
    protected $lyricist;
    protected $musicArrangement;
    protected $musicCompositionForm;
    protected $musicalKey;
    protected $recordedAs;
    protected $type="http://schema.org/MusicComposition";
}