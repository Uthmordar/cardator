<?php

namespace Uthmordar\Cardator\Card\lib;

class ExerciseAction extends PlayAction {

    protected $parents = "Thing\Action\PlayAction";
    protected $distance;
    protected $exerciseCourse;
    protected $exercisePlan;
    protected $exerciseRelatedDiet;
    protected $exerciseType;
    protected $fromLocation;
    protected $opponent;
    protected $sportsActivityLocation;
    protected $sportsEvent;
    protected $sportsTeam;
    protected $toLocation;
    protected $type = "http://schema.org/ExerciseAction";

}
