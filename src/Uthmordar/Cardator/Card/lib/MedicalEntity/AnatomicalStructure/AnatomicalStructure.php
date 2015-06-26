<?php

namespace Uthmordar\Cardator\Card\lib;

class AnatomicalStructure extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $associatedPathophysiology;
    protected $bodyLocation;
    protected $connectedTo;
    protected $diagram;
    protected $function;
    protected $partOfSystem;
    protected $relatedCondition;
    protected $relatedTherapy;
    protected $subStructure;
    protected $type = "http://schema.org/AnatomicalStructure";

}
