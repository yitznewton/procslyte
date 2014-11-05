<?php

namespace Yitznewton\Procslyte\Tests\Render;

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
    /**
     * @test
     */
    public function lowercase()
    {
        $innerRenderer = new ValueRenderer('FoO');
        $renderer = new LowercaseRenderer([], $innerRenderer);
        $this->assertEquals('foo', $renderer->render([]));
    }

    /**
     * @test
     */
    public function uppercase()
    {
        $innerRenderer = new ValueRenderer('FoO');
        $renderer = new UppercaseRenderer([], $innerRenderer);
        $this->assertEquals('FOO', $renderer->render([]));
    }

    /**
     * @test
     */
    public function capitalizeAll()
    {
        $innerRenderer = new ValueRenderer('foo the bar baz');
        $renderer = new CapitalizeAllRenderer([], $innerRenderer);
        $this->assertEquals('Foo The Bar Baz', $renderer->render([]));
    }

    /**
     * @test
     */
    public function capitalizeFirst()
    {
        $innerRenderer = new ValueRenderer('foo the bar baz');
        $renderer = new CapitalizeFirstRenderer([], $innerRenderer);
        $this->assertEquals('Foo the bar baz', $renderer->render([]));
    }

    /**
     * @test
     */
    public function titleCaseWithUpper()
    {
        $innerRenderer = new ValueRenderer('JIM JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim Jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function titleCaseWithUpperAndStopWord()
    {
        $innerRenderer = new ValueRenderer('JIM THE JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim the Jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function titleCaseWithUpperAndStopWordFollowingColon()
    {
        $innerRenderer = new ValueRenderer('JIM: THE JAM');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim: The Jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function titleCaseWithMixed()
    {
        $innerRenderer = new ValueRenderer('jIm jAm');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('jIm jAm', $renderer->render([]));
    }

    /**
     * @test
     */
    public function titleCaseWithMixedHavingUpperWords()
    {
        $innerRenderer = new ValueRenderer('jim ALL jam');
        $renderer = new TitleCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim ALL Jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function sentenceCaseWithBlank()
    {
        $innerRenderer = new ValueRenderer('');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('', $renderer->render([]));
    }

    /**
     * @test
     */
    public function sentenceCaseWithUpper()
    {
        $innerRenderer = new ValueRenderer('JIM ALL JAM');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim all jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function sentenceCaseWithMixedAndFirstLower()
    {
        $innerRenderer = new ValueRenderer('jim ALL jam');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('Jim all jam', $renderer->render([]));
    }

    /**
     * @test
     */
    public function sentenceCaseWithMixed()
    {
        $innerRenderer = new ValueRenderer('jIm ALL jam');
        $renderer = new SentenceCaseRenderer([], $innerRenderer);
        $this->assertEquals('jIm ALL jam', $renderer->render([]));
    }
}
