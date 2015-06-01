<?php

namespace Uthmordar\Cardator\Card\lib;

class Comment extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $downvoteCount;
    protected $parentItem;
    protected $upvoteCount;
    protected $type="http://schema.org/Comment";
}