<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\ConcatenatingRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class ConcatenatingRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testWithTwo()
    {
        $subRenderer = new ValueRenderer('foo');
        $renderer = new ConcatenatingRenderer();
        $renderer->push($subRenderer);
        $renderer->push($subRenderer);
        $this->assertEquals('foofoo', $renderer->render([]));
    }
}
