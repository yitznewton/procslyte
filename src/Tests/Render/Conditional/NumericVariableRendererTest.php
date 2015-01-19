<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class NumericVariableRendererTest extends \PHPUnit_Framework_TestCase
{
    private $variables;

    public function setUp()
    {
        $this->variables = ['foo'];
    }

    /**
     * @test
     */
    public function withEmpty()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new NumericVariableRenderer($this->variables, MultipleMatchRenderer::MATCH_ALL, $innerRenderer);
        $this->assertSame('', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withNumericValue()
    {
        $value = 'bar';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new NumericVariableRenderer($this->variables, MultipleMatchRenderer::MATCH_ALL, $innerRenderer);
        $this->assertEquals($value, $renderer->render(['foo' => '22']));
        $this->assertEquals($value, $renderer->render(['foo' => '22bf']));
        $this->assertEquals($value, $renderer->render(['foo' => 'bf22']));
        $this->assertEquals($value, $renderer->render(['foo' => 'bf22fb']));
        $this->assertEquals($value, $renderer->render(['foo' => '2, 4']));
        $this->assertEquals($value, $renderer->render(['foo' => '2-4']));
        $this->assertEquals($value, $renderer->render(['foo' => '2 & 4']));
        $this->assertEquals($value, $renderer->render(['foo' => '2 - 4']));
        $this->assertEquals($value, $renderer->render(['foo' => '2 , 4']));
    }

    /**
     * @test
     */
    public function withoutNumericValue()
    {
        $innerRenderer = new ValueRenderer('bar');
        $renderer = new NumericVariableRenderer($this->variables, MultipleMatchRenderer::MATCH_ALL, $innerRenderer);
        $this->assertSame('', $renderer->render(['foo' => 'beast']));
        $this->assertSame('', $renderer->render(['foo' => 'beast 2']));
    }
}
