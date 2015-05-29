[![Build Status](https://travis-ci.org/Uthmordar/cardator.svg)](https://travis-ci.org/Uthmordar/cardator)

## Cardator Package

Allows web page parsing and gather microdata.

Filtering\hook possibilities at card instanciation or in PostProcessing.

Output: card collection as hydratated object or json encoding.

```
require_once "vendor/autoload.php";

use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Parser\Parser;

try{
    $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);

    /* give only Article type card in output */
    $cardator->addOnly('Article');

    /* choose url to parse */
    $crawl=$cardator->crawl('cardator/test.html');
    
    $cardator->addPostProcessTreatment('boum', function($name, $value){return 'toto';});
    $cardator->doPostProcess();
    
    /* get json */
    $cards=$cardator->getCards(true);
    
    /* get classes */
    $cards=$cardator->getCards();
    foreach($cards as $c){
        // do something with cards
    }
}catch(\RuntimeException $e){
    // do something with error 
}

```