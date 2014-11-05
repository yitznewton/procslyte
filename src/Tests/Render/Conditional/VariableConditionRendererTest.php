<?php

namespace Yitznewton\Procslyte\Tests\Render;

use Yitznewton\Procslyte\Render\Conditional\MultipleMatchRenderer;
use Yitznewton\Procslyte\Render\Conditional\VariableConditionRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class VariableConditionRendererTest extends \PHPUnit_Framework_TestCase
{
    private $variables = ['title', 'author'];

    /**
     * @test
     */
    public function invalidMatchSetting()
    {
        $this->setExpectedException('\\UnexpectedValueException');
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->variables, 'sadfsdf', $innerRenderer);
        $renderer->render([]);
    }

    /**
     * @test
     */
    public function matchAllWhenMatchingOnlySome()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->variables, MultipleMatchRenderer::MATCH_ALL, $innerRenderer);
        $this->assertEmpty($renderer->render(['title' => 'bar']));
    }

    /**
     * @test
     */
    public function matchAllWhenMatchingAll()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->variables, MultipleMatchRenderer::MATCH_ALL, $innerRenderer);
        $this->assertEquals($value, $renderer->render(['title' => 'bar', 'author' => 'quux']));
    }

    /**
     * @test
     */
    public function matchAnyWhenMatchingSome()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->variables, MultipleMatchRenderer::MATCH_ANY, $innerRenderer);
        $this->assertEquals($value, $renderer->render(['title' => 'bar']));
    }

    /**
     * @test
     */
    public function matchAnyWhenMatchingNone()
    {
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->variables, MultipleMatchRenderer::MATCH_ANY, $innerRenderer);
        $this->assertEmpty($renderer->render([]));
    }

    /**
     * @test
     */
    public function matchNoneWhenMatchingSome()
    {
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->variables, MultipleMatchRenderer::MATCH_NONE, $innerRenderer);
        $this->assertEmpty($renderer->render(['title' => 'bar']));
    }
}
