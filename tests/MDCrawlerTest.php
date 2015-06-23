<?php

use Uthmordar\Cardator\Parser\Facade\MicroDataCrawler;
use Symfony\Component\DomCrawler\Crawler;
use Uthmordar\Cardator\Card\CardGenerator;

class MDCrawlerTest extends \PHPUnit_Framework_TestCase {

    private $MDCrawler;
    private $card;

    public function setUp() {
        $this->MDCrawler = MicroDataCrawler::newInstance();
        $cg = new CardGenerator;
        $this->card = $cg->createCard('Thing');
    }

    public function tearDown() {
        parent::tearDown();
    }

    /**
     * test get itemid property if attr itemid given
     */
    public function testItemid() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            </div>";

        $cr = new Crawler($html);

        $cr->filter('[itemscope]')->each(function($node) {
            $this->assertNull($this->MDCrawler->manageItemIdProperty($node, $this->card));
        });

        $html = "<div itemscope itemtype='http://schema.org/Thing' itemid='bsn:isn:1023'>
            </div>";

        $cr = new Crawler($html);

        $cr->filter('[itemscope]')->each(function($node) {
            $this->assertTrue($this->MDCrawler->manageItemIdProperty($node, $this->card));
        });
        $this->assertEquals($this->card->isn, 1023);
    }

    /**
     * test get itemid property if attr itemid given
     */
    public function testItemref() {
        $html = "<div itemscope itemtype='http://schema.org/Thing' itemref='b c'>
            </div>
            <div id='b'><span itemprop='name'>test_b</span></div>
            <div id='c'><span itemprop='description'>description</span>
            <span itemscope itemtype='http://schema.org/Thing'><p>test<span itemprop='no_scope'>test</span></p></span>
            </div>";

        $cr = new Crawler($html);

        $cr->filter('[itemscope]')->each(function($node) use ($cr) {
            $this->MDCrawler->manageItemrefProperty($node, $this->card, $cr);
        });
        $this->assertEquals($this->card->name, 'test_b');
        $this->assertEquals($this->card->description, 'description');
        $this->assertNull($this->card->no_scope);
    }

    /**
     * test extract raw attr if exist
     */
    public function testRawProperty() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            <span itemprop='raw' dk-raw='raw_value'>Test</span>
            <meta itemprop='content_meta' content='raw_content'>
            </div>";

        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) {
            $this->MDCrawler->getScopeContent($node, $this->card, false);
        });

        $this->assertEquals($this->card->raw, 'raw_value');
        $this->assertEquals($this->card->content_meta, 'raw_content');
    }

    /**
     * test extraction src or itemprop image content if exist
     */
    public function testImgProperty() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            <img itemprop='test_src' src='http://test.fr'/>
            <meta itemprop='image' content='test.fr'>
            </div>";

        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) {
            $this->MDCrawler->getScopeContent($node, $this->card, false);
        });

        $this->assertEquals($this->card->test_src, 'http://test.fr');
        $this->assertEquals($this->card->image, '/test.fr');
    }

    /**
     * test extraction value if val attr is found
     */
    public function testValueProperty() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            <span itemprop='has_val' value='13'>No extract</span>
            </div>";

        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) {
            $this->MDCrawler->getScopeContent($node, $this->card, false);
        });
        $this->assertEquals($this->card->has_val, 13);
    }

    /**
     * test extraction href if exist
     */
    public function testLinkProperty() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            <a href='test.url' itemprop='is_link'>ancre</a>
            <a href='' itemprop='is_empty'>ancre</a>
            <a href='test.url#ancre' itemprop='is_ancre'>ancre</a>
            <a href='?param' itemprop='is_param'>ancre</a>
            </div>";

        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) {
            $this->MDCrawler->getScopeContent($node, $this->card, false);
        });
        $this->assertEquals($this->card->is_link, '/test.url');
        $this->assertEquals($this->card->is_empty, 'ancre');
        $this->assertEquals($this->card->is_ancre, '/test.url#ancre');
        $this->assertEquals($this->card->is_param, '?param');
    }

    /**
     * test extract nested card
     */
    public function testNestedScope() {
        $html = "<div itemscope itemtype='http://schema.org/Thing'>
            <span itemprop='description'>description</span>
            <span itemprop='subcard' itemscope itemtype='http://schema.org/Thing'><p>test<span itemprop='no_scope'>test</span></p></span>
            </div>";

        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) {
            $this->MDCrawler->getScopeContent($node, $this->card, false);
        });

        $this->assertEquals($this->card->childList, ['subcard']);
    }
    
    /**
     * test extract nested card by itemref && generation of approprieted subcard
     * @dataProvider providerNestedScope
     */
    public function testNestedScopeItemref($html) {
        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) use($cr) {
            $this->MDCrawler->manageItemrefProperty($node, $this->card, $cr);
        });
        $this->assertTrue($this->card->nested instanceof \Uthmordar\Cardator\Card\lib\iCard);
    }

    public function providerNestedScope() {
        return [
            ["<div itemscope itemtype='http://schema.org/Thing' itemref='c'>
            </div>
            <div id='c'><span itemprop='description'>description</span>
            <span itemscope itemtype='http://schema.org/Thing' itemprop='nested'><p>test<span itemprop='no_scope'>test</span></p></span>
            </div>"],
            ["<div itemscope itemtype='http://schema.org/Thing' itemref='c'>
            </div>
            <div id='c'><span itemprop='description'>description</span>
            <span itemscope itemtype='http://schema.org/Inexist' itemprop='nested'><p>test<span itemprop='no_scope'>test</span></p></span>
            </div>"]
        ];
    }

    /**
     * test extraction card type from crawler
     * @dataProvider cardTypeProvider
     */
    public function testGetCardType($html, $expect) {
        $cr = new Crawler($html);
        $cr->filter('[itemscope]')->each(function($node) use ($expect) {
            $this->assertEquals($expect, $this->MDCrawler->getCardTypeFromCrawler($node));
        });
    }

    public function cardTypeProvider() {
        return [
            ["<div itemscope itemtype='http://schema.org/Thing'>
            </div>", 'Thing'],
            ["<div'>
            </div>", 'Thing'],
            ["<div itemscope itemtype='http://template.org/Article'>
            </div>", 'Article']
        ];
    }

}
