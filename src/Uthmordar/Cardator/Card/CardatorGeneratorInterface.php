<?php

namespace Uthmordar\Cardator\Card;

interface CardatorGeneratorInterface {

    public function createCard($type);

    public function checkClassExists($class, $type);
}
