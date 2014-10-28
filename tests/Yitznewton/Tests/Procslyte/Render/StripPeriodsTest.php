<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\StripPeriodsRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class StripPeriodsTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $innerRenderer = new ValueRenderer('.f.o.o.');
        $renderer = new StripPeriodsRenderer([], $innerRenderer);
        $this->assertEquals('foo', $renderer->render([]));
    }
}
