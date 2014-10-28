<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\PrefixRenderer;

class PrefixRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testWithNoPrefix()
    {
        $internalString = 'foo';
        $internalRenderer = new StubRenderer($internalString);
        $prefixRenderer = new PrefixRenderer([], $internalRenderer);
        $this->assertEquals($internalString, $prefixRenderer->render([]));
    }

    public function testWithPrefix()
    {
        $internalString = 'foo';
        $prefix = 'bar';
        $internalRenderer = new StubRenderer($internalString);
        $prefixRenderer = new PrefixRenderer(['prefix' => $prefix], $internalRenderer);
        $this->assertEquals($prefix . $internalString, $prefixRenderer->render([]));
    }
}
