<?php

namespace Uthmordar\Cardator\Card;

interface iCardatorGenerator{ 
    public function createCard($type);
    public function checkLib($class, $type);
}