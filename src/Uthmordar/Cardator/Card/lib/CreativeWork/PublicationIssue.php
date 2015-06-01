<?php

namespace Uthmordar\Cardator\Card\lib;

class PublicationIssue extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $issueNumber;
    protected $pageEnd;
    protected $pageStart;
    protected $pagination;
    protected $type="http://schema.org/PublicationIssue";
}