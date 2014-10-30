<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Locale;
use Yitznewton\Procslyte\Render\QuotesRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class QuotesRendererTest extends \PHPUnit_Framework_TestCase
{
    private $value;
    private $innerRenderer;

    public function setUp()
    {
        $this->value = 'foo.';
        $this->innerRenderer = new ValueRenderer($this->value);
    }

    public function testRenderWithPunctuationInQuote()
    {
        $renderer = $this->createRenderer(['punctuationInQuote' => true]);
        $this->assertEquals('"foo."', $renderer->render([]));
    }

    public function testRenderWithPunctuationOutsideOfQuote()
    {
        $renderer = $this->createRenderer(['punctuationInQuote' => false]);
        $this->assertEquals('"foo".', $renderer->render([]));
    }

    public function testRenderWithNoPunctuationOutsideOfQuote()
    {
        $locale = new Locale(['punctuationInQuote' => false], new \stdClass());
        $this->innerRenderer = new ValueRenderer('foo');
        $renderer = new QuotesRenderer([], $this->innerRenderer, $locale);
        $this->assertEquals('"foo"', $renderer->render([]));
    }

    public function testRenderWithDefaultPunctuationInQuote()
    {
        $renderer = $this->createRenderer([]);
        $this->assertEquals('"foo".', $renderer->render([]));
    }

    private function createRenderer($localeStyleOptions)
    {
        $locale = new Locale($localeStyleOptions, new \stdClass());
        return new QuotesRenderer([], $this->innerRenderer, $locale);
    }
}
