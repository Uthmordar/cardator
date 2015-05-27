<?php

namespace Uthmordar\Cardator\Card\lib;

class ReviewAction extends AssessAction{
    protected $parents="Thing\Action\AssessAction";
    protected $resultReview;
    protected $type="http://schema.org/ReviewAction";
}