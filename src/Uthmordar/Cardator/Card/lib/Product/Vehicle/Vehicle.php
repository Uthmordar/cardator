<?php

namespace Uthmordar\Cardator\Card\lib;

class Vehicle extends Product{
    protected $parents="Thing\Product";
    protected $cargoVolume;
    protected $dateVehicleFirstRegistered;
    protected $driveWheelConfiguration;
    protected $fuelConsumption;
    protected $fuelEfficiency;
    protected $fuelType;
    protected $knownVehicleDamages;
    protected $mileageFromOdometer;
    protected $numberOfAirbags;
    protected $numberOfAxles;
    protected $numberOfDoors;
    protected $numberOfForwardGears;
    protected $numberOfPreviousOwners;
    protected $productionDate;
    protected $purchaseDate;
    protected $steeringPosition;
    protected $vehicleConfiguration;
    protected $vehicleEngine;
    protected $vehicleIdentificationNumber;
    protected $vehicleInteriorColor;
    protected $vehicleInteriorType;
    protected $vehicleModelDate;
    protected $vehicleSeatingCapacity;
    protected $vehicleTransmission;
    protected $type="http://schema.org/Vehicle";
}