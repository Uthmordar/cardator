<?php

namespace Uthmordar\Cardator\Card;

interface CardatorContainerInterface {

    public function addCard(lib\CardInterface $card);

    public function getCards();
}
