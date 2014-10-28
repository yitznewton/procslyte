<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\TextCase\CapitalizeAllRenderer;
use Yitznewton\Procslyte\Render\TextCase\CapitalizeFirstRenderer;
use Yitznewton\Procslyte\Render\TextCase\LowercaseRenderer;
use Yitznewton\Procslyte\Render\TextCase\TitleCaseRenderer;
use Yitznewton\Procslyte\Render\TextCase\UppercaseRenderer;

class CaseRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testLowercase()
    {
        $innerRenderer = new StubRenderer('FoO');
        $renderer = new LowercaseRenderer([], $innerRenderer);
        $this->assertEquals('foo', $renderer->render([]));
    }

    public function testUppercase()
    {
        $innerRenderer = new StubRenderer('FoO');
        $renderer = new UppercaseRenderer([], $innerRenderer);
        $this->assertEquals('FOO', $renderer->render([]));
    }

    public function testCapitalizeAll()
    {
        $innerRenderer = new StubRenderer('foo the bar baz');
        $renderer = new CapitalizeAllRenderer([], $innerRenderer);
        $this->assertEquals('Foo The Bar Baz', $renderer->render([]));
    }

    public function testCapitalizeFirst()
    {
        $innerRenderer = new StubRenderer('foo the bar baz');
        $renderer = new CapitalizeFirstRenderer([], $innerRenderer);
        $this->assertEquals('Foo the bar baz', $renderer->render([]));
    }

    public function testTitleCaseWithUpper()
    {
        $innerRenderer = new StubRenderer('JIM JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim Jam', $renderer->render([]));
    }

    public function testTitleCaseWithUpperAndStopWord()
    {
        $innerRenderer = new StubRenderer('JIM THE JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim the Jam', $renderer->render([]));
    }

    public function testTitleCaseWithMixed()
    {
        $innerRenderer = new StubRenderer('jIm jAm');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('jIm jAm', $renderer->render([]));
    }

    public function testTitleCaseWithMixedHavingUpperWords()
    {
        $innerRenderer = new StubRenderer('jim ALL jam');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim ALL Jam', $renderer->render([]));
    }
}
