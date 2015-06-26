<?php

namespace Uthmordar\Cardator\Card\lib;

class Book extends CreativeWork {

    protected $parents = "Thing\CreativeWork";
    protected $bookEdition;
    protected $bookFormat;
    protected $illustrator;
    protected $isbn;
    protected $numberOfPages;
    protected $type = "http://schema.org/Book";

}
