<?php

namespace Uthmordar\Cardator\Card\lib;

interface iCard{ 
    public function __get($name);
    public function __set($name, $value);
    public function __call($name, $arguments);
}