<?php

namespace Uthmordar\Cardator\Card\lib;

class Event extends Thing{
    protected $parents="Thing";
    protected $aggregateRating;
    protected $attendee;
    protected $doorTime;
    protected $duration;
    protected $endDate;
    protected $eventStatus;
    protected $inLanguage;
    protected $location;
    protected $offers;
    protected $organizer;
    protected $organization;
    protected $performer;
    protected $previousStartDate;
    protected $recordedIn;
    protected $review;
    protected $startDate;
    protected $subEvent;
    protected $superEvent;
    protected $typicalAgeRange;
    protected $workPerformed;
    protected $type="http://schema.org/Event";
}