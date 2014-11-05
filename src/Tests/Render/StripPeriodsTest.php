<?php

namespace Yitznewton\Procslyte\Tests\Render;

use Yitznewton\Procslyte\Render\StripPeriodsRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class StripPeriodsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function render()
    {
        $innerRenderer = new ValueRenderer('.f.o.o.');
        $renderer = new StripPeriodsRenderer([], $innerRenderer);
        $this->assertEquals('foo', $renderer->render([]));
    }
}
