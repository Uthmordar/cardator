<?php

use Uthmordar\Cardator\Card\CardProcessor;

class CardProcessorTest extends \PHPUnit_Framework_TestCase {

    private $container;
    private $mock;
    private $mock1;
    private $mockArticle;

    public function setUp() {
        $this->container = new CardProcessor;
        $this->mock = $this->getMock('Uthmordar\Cardator\Card\lib\Thing', array(), array());
        $this->mock1 = $this->getMock('Uthmordar\Cardator\Card\lib\Thing', array(), array());
        $this->mockArticle = $this->getMock('Uthmordar\Cardator\Card\lib\Article', [], []);
    }

    public function tearDown() {
        parent::tearDown();
    }

    /**
     * test card storage
     */
    public function testAddCard() {
        $this->container->addCard($this->mock);
        $this->container->addCard($this->mock1);
        return $this->container;
    }

    /**
     * test getting card from storage && expecting getting all card
     * @depends testAddCard
     */
    public function testGetNonFilterCards($container) {
        $cards = $container->getNonFilterCards();
        foreach ($cards as $card) {
            $this->assertTrue($card instanceof \Uthmordar\Cardator\Card\lib\CardInterface);
        }
        $this->assertEquals(2, count($cards));
    }

    /**
     * test getting card from storage && expecting getting card collection
     * @depends testAddCard
     */
    public function testGetCards($container) {
        $cards = $container->getCards();
        $this->assertTrue($cards instanceof \Uthmordar\Cardator\Card\CardCollection);
        $this->assertTrue($cards->getCards() instanceof \Uthmordar\Cardator\Card\CardCollection);
    }

    /**
     * test getting card from storage with json param && expecting getting string result
     */
    public function testGetJsonCards() {
        $card = new Uthmordar\Cardator\Card\lib\Thing;
        $this->container->addCard($card);
        $json = $this->container->getCards(true);
        $this->assertTrue(is_string($json));
    }

    /**
     * expect error if iCard is not implemented
     * @expectedException PHPUnit_Framework_Error
     */
    public function testNotACardGiven() {
        $this->assertFalse($this->container->addCard('toto'));
    }

    /**
     * test keeping all card with addOnly active, but only returning filter allowed card
     */
    public function testAddOnly() {
        $this->container->addOnly('Thing');
        $this->container->addOnly(['Thing']);
        $this->container->addCard(new Uthmordar\Cardator\Card\lib\Thing);
        $this->container->addCard(new \Uthmordar\Cardator\Card\lib\Article);
        $cards = $this->container->getNonFilterCards();
        $this->assertEquals(2, count($cards));

        $cards = $this->container->getCards();
        $this->assertEquals(1, count($cards));
    }

    /**
     * test keeping all card with addExcept active, but only returning filter allowed card
     */
    public function testAddExcept() {
        $this->container->addExcept(['Article']);
        $this->container->addExcept('Thing');
        $this->container->addCard(new Uthmordar\Cardator\Card\lib\Thing);
        $this->container->addCard(new \Uthmordar\Cardator\Card\lib\Article);
        $this->container->addCard(new \Uthmordar\Cardator\Card\lib\NewsArticle);
        $cards = $this->container->getNonFilterCards();
        $this->assertEquals(3, count($cards));

        $cards = $this->container->getCards();
        $this->assertEquals(1, count($cards));
    }

    /**
     * test add filter only take closure as 2nd params
     * @expectedException PHPUnit_Framework_Error
     */
    public function testAddPostProcessTreatment() {
        $this->container->addPostProcessTreatment('filter_test', 'test');
        $this->assertTrue($this->container->addPostProcessTreatment('filter_test', function() {
                    
                }));
    }

    public function testDoPostProcess() {
        $card = new Uthmordar\Cardator\Card\lib\Thing;
        $card->testProp = 'toto';
        $this->container->addCard($card);
        $this->container->addPostProcessTreatment('testProp', function($name, $value) {
            return 'titi';
        });
        $this->container->doPostProcess();
        $this->assertEquals('titi', $card->testProp);
    }

    public function testDoPostProcessOnArray() {
        $card = new Uthmordar\Cardator\Card\lib\Thing;
        $card->testProp = ['toto', 'toto2'];
        $this->container->addCard($card);
        $this->container->addPostProcessTreatment('testProp', function($name, $value) {
            return 'titi';
        });
        $this->container->doPostProcess();
        $this->assertEquals(['titi', 'titi'], $card->testProp);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testApplyFilterOnProperty() {
        $card = new Uthmordar\Cardator\Card\lib\Thing;
        $this->assertFalse($this->container->applyFilterOnProperty($card, 'test_no_prop', function($name, $value) {
                    return 'titi';
                }));
        $card->test_no_prop(['filtered' => $this->container->getFilterResultOnProperty($card, 'test_no_prop', function($name, $value) {
                        return 'titi';
                    }), 'replace' => true]);
    }

    /**
     * test data conversion for card arrayfication
     */
    public function testCreateArrayCard() {
        $card = new Uthmordar\Cardator\Card\lib\Thing;
        $card->dateTest = new Datetime();
        $card->cardTest = new Uthmordar\Cardator\Card\lib\Thing;
        $card->test = ['test', 'test2'];
        $array = $this->container->createArrayCard($card);
        $this->assertEquals($array['test'], ['test', 'test2']);
        $this->assertTrue(is_array($array['cardTest']));
    }

}
