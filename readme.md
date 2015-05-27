[![Build Status](https://travis-ci.org/Uthmordar/cardator.svg)](https://travis-ci.org/Uthmordar/cardator)

## Cardator Package

Allows web page parsing, gather microdata and return card object depending on the web semantic

require_once "vendor/autoload.php";

use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardContainer;
use Uthmordar\Cardator\Cardator;

try{
    $cardator=new Cardator(new CardGenerator, new CardContainer);

    $card=$cardator->createCard('Event');

    $card->description='toto';
    $card->url("url");

    $cardator->saveCard($card);

    $cards=$cardator->getCards();

    foreach($cards as $c){
        // do something with cards
    }
}catch(\RuntimeException $e){
    // do something with error 
}