<?php

namespace Uthmordar\Cardator\Card\lib;

class Question extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $acceptedAnswer;
    protected $answer;
    protected $downvoteCount;
    protected $suggestedAnswer;
    protected $upvoteCount;
    protected $type="http://schema.org/Question";
}