<?php

namespace Uthmordar\Cardator\Card\lib;

class VisualArtwork extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $artEdition;
    protected $artMedium;
    protected $artform;
    protected $artworkSurface;
    protected $depth;
    protected $height;
    protected $width;
    protected $type="http://schema.org/VisualArtwork";
}