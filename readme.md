[![Build Status](https://travis-ci.org/Uthmordar/cardator.svg)](https://travis-ci.org/Uthmordar/cardator)

## Cardator Package

Allows web page parsing, gather microdata and return card object depending on the web semantic

```
require_once "vendor/autoload.php";

use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Parser\Parser;

try{
    $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);
    //$cardator->addOnly('Article');
    $crawl=$cardator->crawl('cardator/test.html');
    
    $cardator->addPostProcessTreatment('boum', function($name, $value){return 'toto';});
    $cardator->doPostProcess();
    
    /* get json */
    $cards=$cardator->getCards(true);
    
    /* get classes */
    $cards=$cardator->getCards();
    foreach($cards as $c){
        var_dump($c);
        // do something with cards
    }
}catch(\RuntimeException $e){
    var_dump($e->getMessage());
    // do something with error 
}

```