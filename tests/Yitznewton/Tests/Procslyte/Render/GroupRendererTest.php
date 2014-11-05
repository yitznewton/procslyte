<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\GroupRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class GroupRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function withChildRenderers()
    {
        $firstValue = 'a';
        $secondValue = 'b';
        $firstInner = new ValueRenderer($firstValue);
        $secondInner = new ValueRenderer($secondValue);
        $renderer = new GroupRenderer();
        $renderer->addInnerRenderer($firstInner);
        $renderer->addInnerRenderer($secondInner);
        $this->assertEquals($firstValue . $secondValue, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withDelimiterAndTwoChildRenderers()
    {
        $firstValue = 'a';
        $secondValue = 'b';
        $delimiter = '_';
        $firstInner = new ValueRenderer($firstValue);
        $secondInner = new ValueRenderer($secondValue);
        $renderer = new GroupRenderer(['delimiter' => $delimiter]);
        $renderer->addInnerRenderer($firstInner);
        $renderer->addInnerRenderer($secondInner);
        $this->assertEquals($firstValue . $delimiter . $secondValue, $renderer->render([]));
    }
}
