<?php

namespace Uthmordar\Cardator\Card;

interface iCardatorGenerator {

    public function createCard($type);

    public function checkClassExists($class, $type);
}
