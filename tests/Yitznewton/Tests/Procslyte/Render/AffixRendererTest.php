<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\AffixRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class AffixRendererTest extends \PHPUnit_Framework_TestCase
{
    private $internalString;
    private $internalRenderer;

    public function setUp()
    {
        $this->internalString = 'foo';
        $this->internalRenderer = new ValueRenderer($this->internalString);
    }

    /**
     * @test
     */
    public function withNothing()
    {
        $affixRenderer = new AffixRenderer([], $this->internalRenderer);
        $this->assertEquals($this->internalString, $affixRenderer->render([]));
    }

    /**
     * @test
     */
    public function withPrefix()
    {
        $prefix = 'bar';
        $affixRenderer = new AffixRenderer(['prefix' => $prefix], $this->internalRenderer);
        $this->assertEquals($prefix . $this->internalString, $affixRenderer->render([]));
    }

    /**
     * @test
     */
    public function withSuffix()
    {
        $suffix = 'bar';
        $affixRenderer = new AffixRenderer(['suffix' => $suffix], $this->internalRenderer);
        $this->assertEquals($this->internalString . $suffix, $affixRenderer->render([]));
    }
}
