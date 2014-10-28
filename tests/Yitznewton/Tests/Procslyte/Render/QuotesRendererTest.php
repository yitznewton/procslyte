<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Locale;
use Yitznewton\Procslyte\Render\QuotesRenderer;

class QuotesRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderWithPunctuationInQuote()
    {
        $value = 'foo.';
        $innerRenderer = new StubRenderer($value);
        $locale = new Locale(['styleOptions' => ['punctuationInQuote' => true]]);
        $renderer = new QuotesRenderer([], $innerRenderer, $locale);
        $this->assertEquals("\"$value\"", $renderer->render([]));
    }

    public function testRenderWithPunctuationOutsideOfQuote()
    {
        $innerRenderer = new StubRenderer('foo.');
        $locale = new Locale(['styleOptions' => ['punctuationInQuote' => false]]);
        $renderer = new QuotesRenderer([], $innerRenderer, $locale);
        $this->assertEquals('"foo".', $renderer->render([]));
    }

    public function testRenderWithDefaultPunctuationInQuote()
    {
        $innerRenderer = new StubRenderer('foo.');
        $locale = new Locale([]);
        $renderer = new QuotesRenderer([], $innerRenderer, $locale);
        $this->assertEquals('"foo".', $renderer->render([]));
    }
}
