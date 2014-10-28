<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\AffixRenderer;

class AffixRendererTest extends \PHPUnit_Framework_TestCase
{
    private $internalString;
    private $internalRenderer;

    public function setUp()
    {
        $this->internalString = 'foo';
        $this->internalRenderer = new StubRenderer($this->internalString);
    }

    public function testWithNothing()
    {
        $affixRenderer = new AffixRenderer([], $this->internalRenderer);
        $this->assertEquals($this->internalString, $affixRenderer->render([]));
    }

    public function testWithPrefix()
    {
        $prefix = 'bar';
        $affixRenderer = new AffixRenderer(['prefix' => $prefix], $this->internalRenderer);
        $this->assertEquals($prefix . $this->internalString, $affixRenderer->render([]));
    }

    public function testWithSuffix()
    {
        $suffix = 'bar';
        $affixRenderer = new AffixRenderer(['suffix' => $suffix], $this->internalRenderer);
        $this->assertEquals($this->internalString . $suffix, $affixRenderer->render([]));
    }
}
