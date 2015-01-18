<?php

namespace Yitznewton\Procslyte\Tests\Render\Conditional;

use Yitznewton\Procslyte\Render\Conditional\IfElseRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class IfElseRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function withNoRenderers()
    {
        $renderer = new IfElseRenderer();
        $this->assertSame('', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withDefault()
    {
        $value = 'foo';
        $renderer = new IfElseRenderer();
        $renderer->setDefaultRenderer(new ValueRenderer($value));
        $this->assertEquals($value, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withOneNonemptyConditional()
    {
        $value = 'foo';
        $renderer = new IfElseRenderer();
        $renderer->addConditionalRenderer(new ValueRenderer($value));
        $this->assertSame($value, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withOneEmptyConditional()
    {
        $renderer = new IfElseRenderer();
        $renderer->addConditionalRenderer(new ValueRenderer(''));
        $this->assertSame('', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withOneEmptyAndOneNonemptyConditional()
    {
        $value = 'foo';
        $renderer = new IfElseRenderer();
        $renderer->addConditionalRenderer(new ValueRenderer(''));
        $renderer->addConditionalRenderer(new ValueRenderer($value));

        $this->assertEquals($value, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withOneEmptyAndDefault()
    {
        $value = 'foo';
        $renderer = new IfElseRenderer();
        $renderer->addConditionalRenderer(new ValueRenderer(''));
        $renderer->setDefaultRenderer(new ValueRenderer($value));

        $this->assertEquals($value, $renderer->render([]));
    }
}
