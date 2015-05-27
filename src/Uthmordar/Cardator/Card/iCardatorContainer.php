<?php

namespace Uthmordar\Cardator\Card;

interface iCardatorContainer{ 
    public function addCard(lib\iCard $card);
    public function getCards();
}