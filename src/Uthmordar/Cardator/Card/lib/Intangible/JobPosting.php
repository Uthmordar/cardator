<?php

namespace Uthmordar\Cardator\Card\lib;

class JobPosting extends Intangible{
    protected $parents="Thing\Intangible";
    protected $baseSalary;
    protected $datePosted;
    protected $educationRequirements;
    protected $employmentType;
    protected $experienceRequirements;
    protected $hiringOrganization;
    protected $incentiveCompensation;
    protected $industry;
    protected $jobBenefits;
    protected $jobLocation;
    protected $occupationalCategory;
    protected $qualifications;
    protected $responsibilities;
    protected $salaryCurrency;
    protected $skills;
    protected $specialCommitments;
    protected $title;
    protected $workHours;
    protected $type="http://schema.org/JobPosting";
}