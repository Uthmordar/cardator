<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalStudy extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $outcome;
    protected $population;
    protected $sponsor;
    protected $status;
    protected $studyLocation;
    protected $studySubject;
    protected $type = "http://schema.org/MedicalStudy";

}
