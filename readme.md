[![Build Status](https://travis-ci.org/Uthmordar/cardator.svg)](https://travis-ci.org/Uthmordar/cardator)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4d9c8cb3-c1da-470a-971a-5f08493741ac/mini.png)](https://insight.sensiolabs.com/projects/4d9c8cb3-c1da-470a-971a-5f08493741ac)

## Cardator Package

v 1.3.3

Allows web page parsing and gather microdata.

Filtering\hook possibilities at card instanciation or in PostProcessing.

Output: card collection as hydratated object or json encoded string.

### Base Utilisation:

**require a composer dump-autoload --optimize** 

```
require_once "vendor/autoload.php";

use Uthmordar\Cardator\Card\CardGenerator;
use Uthmordar\Cardator\Card\CardProcessor;
use Uthmordar\Cardator\Cardator;
use Uthmordar\Cardator\Parser\Parser;

try{
    $cardator=new Cardator(new CardGenerator, new CardProcessor, new Parser);

    /* give only Article type card in output (only has priority over except) */
    $cardator->addOnly('Article');

    /* Thing type card will not be given in output */
    $cardator->addExcept('Thing');

    /* choose url to crawl and extract data, throw RuntimeException if header status 400+ */
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

### Extracted data format :

This tool crawl webpages searching for [microdata](https://html.spec.whatwg.org/multipage/microdata.html) specifications.

It will also tracks some special attributes and link them to given itemprop:
  * dk-raw is an attribute you should use to give informations usable only by developers or robots such as datetime instead of human readable date.
  * content attribute could be use on meta tag to mark content hide to user
  * value attr could be use to pass numeric value related to tag 


You could access some processing informations as follow:

```
    $cardator->getTotalCard(); // Give number of card found
    $cardator->getExecutionTime(); // return crawl duration in s
    $cardator->getStatus(); // return crawler http status

    $cardator->getExecutionData(); // return previous informations as array
```


### Card generation:

You could easily create Card object with:

```
    $cardator->createCard('Article');
```

You could change card library by extending CardGenerator and giving a new library namespacing path as long as you respect interface implementation for cards 


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
    // if more than one parent exist for an item : [['Thing', 'CreativeWork', 'SoftwareApplication'], ['Thing', 'CreativeWork', 'Game']]
    $cardParents=$article->getParents();
    OR 
    $cardParents=$article->parents;
    // will return 'Thing\CreativeWork\SoftawareApplication::Thing\CreativeWork\Game'

    // Return the direct parent Name
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
