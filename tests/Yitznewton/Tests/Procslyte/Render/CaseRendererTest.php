<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\Text\ValueRenderer;
use Yitznewton\Procslyte\Render\TextCase\CapitalizeAllRenderer;
use Yitznewton\Procslyte\Render\TextCase\CapitalizeFirstRenderer;
use Yitznewton\Procslyte\Render\TextCase\LowercaseRenderer;
use Yitznewton\Procslyte\Render\TextCase\SentenceCaseRenderer;
use Yitznewton\Procslyte\Render\TextCase\TitleCaseRenderer;
use Yitznewton\Procslyte\Render\TextCase\UppercaseRenderer;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class CaseRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testLowercase()
    {
        $innerRenderer = new ValueRenderer('FoO');
        $renderer = new LowercaseRenderer([], $innerRenderer);
        $this->assertEquals('foo', $renderer->render([]));
    }

    public function testUppercase()
    {
        $innerRenderer = new ValueRenderer('FoO');
        $renderer = new UppercaseRenderer([], $innerRenderer);
        $this->assertEquals('FOO', $renderer->render([]));
    }

    public function testCapitalizeAll()
    {
        $innerRenderer = new ValueRenderer('foo the bar baz');
        $renderer = new CapitalizeAllRenderer([], $innerRenderer);
        $this->assertEquals('Foo The Bar Baz', $renderer->render([]));
    }

    public function testCapitalizeFirst()
    {
        $innerRenderer = new ValueRenderer('foo the bar baz');
        $renderer = new CapitalizeFirstRenderer([], $innerRenderer);
        $this->assertEquals('Foo the bar baz', $renderer->render([]));
    }

    public function testTitleCaseWithUpper()
    {
        $innerRenderer = new ValueRenderer('JIM JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim Jam', $renderer->render([]));
    }

    public function testTitleCaseWithUpperAndStopWord()
    {
        $innerRenderer = new ValueRenderer('JIM THE JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim the Jam', $renderer->render([]));
    }

    public function testTitleCaseWithUpperAndStopWordFollowingColon()
    {
        $innerRenderer = new ValueRenderer('JIM: THE JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim: The Jam', $renderer->render([]));
    }

    public function testTitleCaseWithMixed()
    {
        $innerRenderer = new ValueRenderer('jIm jAm');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('jIm jAm', $renderer->render([]));
    }

    public function testTitleCaseWithMixedHavingUpperWords()
    {
        $innerRenderer = new ValueRenderer('jim ALL jam');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim ALL Jam', $renderer->render([]));
    }

    public function testSentenceCaseWithBlank()
    {
        $innerRenderer = new ValueRenderer('');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('', $renderer->render([]));
    }

    public function testSentenceCaseWithUpper()
    {
        $innerRenderer = new ValueRenderer('JIM ALL JAM');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim all jam', $renderer->render([]));
    }

    public function testSentenceCaseWithMixedAndFirstLower()
    {
        $innerRenderer = new ValueRenderer('jim ALL jam');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim all jam', $renderer->render([]));
    }

    public function testSentenceCaseWithMixed()
    {
        $innerRenderer = new ValueRenderer('jIm ALL jam');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('jIm ALL jam', $renderer->render([]));
    }
}
