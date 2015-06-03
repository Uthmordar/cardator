[![Build Status](https://travis-ci.org/Uthmordar/cardator.svg)](https://travis-ci.org/Uthmordar/cardator)

## Cardator Package

Allows web page parsing and gather microdata.

Filtering\hook possibilities at card instanciation or in PostProcessing.

Output: card collection as hydratated object or json encoded string.

### Exemple:

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

    /* Thing type card will not be given in output */
    $cardator->addExcept('Thing');

    /* choose url to crawl and extract data */
    $crawl=$cardator->crawl('http://google.fr');
    
    /* given closure will be use on given property for all card during the postprocess */
    $cardator->addPostProcessTreatment('my_property_to_filter', function($name, $value){
        // what I want to do
    });
    $cardator->doPostProcess();
    
    /* get cards as json */
    $cards=$cardator->getCards(true);
    
    /* get cards as SplObjectStorage collection */
    $cards=$cardator->getCards();
    foreach($cards as $c){
        // do something with cards
    }
}catch(\RuntimeException $e){
    // do something with error 
}

```


### Card generation:

You could easily create Card object with:

```
    $cardator->createCard('Article');
```

### Card properties:

```
    $article=$cardator->createCard('Article');
    
    // GET
    $name=$article->name;
    $name=$article->name();
    // SET
    $article->name='My Article';
    $article->name('My Article');

    // Existant properties will be hydrated, non-existant property will create an entry in $params array
    $article->params['non-existant'];

    // You could access to all hydrated properties name in an array
    $properties=$article->properties;

    // Card type and card hierarchy
    $cardName=$article->getQualifiedName();
    $cardType=$article->type;

    // Parents : will return an array ['Thing', 'CreativeWork']
    // if more than one parent exist for a level : ['Thing', 'CreativeWork::SoftwareApplication']
    $cardParents=$article->getParents();
    $cardDirectParent=$article->getDirectparent();

```

### Data Processing: filter properties value

As seen before you could add PostProcessing globally on cardator:

```
    $cardator->addPostProcessTreatment('my_property_to_filter', function($name, $value){
        // what I want to do
    });
```

If you want to create more specific treatment you could also edit the Card in card library as follow:

```
    public function __construct(){
        $this->addFilter('my_property_to_filter', function($name, $value){
            // what I want to do
        });
    }
```

It is also possible to edit your own processing action in Card\lib\FilterCard:

```
    $filter=[
        'my_property_to_filter'=>'function to call'
    ];
```