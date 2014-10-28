<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\AffixRenderer;

class AffixRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testWithNothing()
    {
        $internalString = 'foo';
        $internalRenderer = new StubRenderer($internalString);
        $affixRenderer = new AffixRenderer([], $internalRenderer);
        $this->assertEquals($internalString, $affixRenderer->render([]));
    }

    public function testWithPrefix()
    {
        $internalString = 'foo';
        $prefix = 'bar';
        $internalRenderer = new StubRenderer($internalString);
        $affixRenderer = new AffixRenderer(['prefix' => $prefix], $internalRenderer);
        $this->assertEquals($prefix . $internalString, $affixRenderer->render([]));
    }

    public function testWithSuffix()
    {
        $internalString = 'foo';
        $suffix = 'bar';
        $internalRenderer = new StubRenderer($internalString);
        $affixRenderer = new AffixRenderer(['suffix' => $suffix], $internalRenderer);
        $this->assertEquals($internalString . $suffix, $affixRenderer->render([]));
    }
}
