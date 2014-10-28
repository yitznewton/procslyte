<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\LowercaseRenderer;
use Yitznewton\Procslyte\Render\UppercaseRenderer;

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
}
