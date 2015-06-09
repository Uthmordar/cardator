<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalTestPanel extends MedicalTest{
    protected $parents="Thing\MedicalEntity\MedicalTest";
    protected $subTest;
    protected $type="http://schema.org/MedicalTestPanel";
}