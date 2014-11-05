<?php

namespace Yitznewton\Procslyte\Tests\Render;

use Yitznewton\Procslyte\Render\Conditional\VariableConditionRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class VariableConditionRendererTest extends \PHPUnit_Framework_TestCase
{
    private $settings = ['variables' => ['title', 'author']];

    /**
     * @test
     */
    public function invalidMatchSetting()
    {
        $this->setExpectedException('\\UnexpectedValueException');
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'fasdf'], $innerRenderer);
        $renderer->render([]);
    }

    /**
     * @test
     */
    public function defaultMatchWhenMatchingAll()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->settings, $innerRenderer);
        $this->assertEquals($value, $renderer->render(['title' => 'bar', 'author' => 'quux']));
    }

    /**
     * @test
     */
    public function defaultMatchWhenMatchingOnlySome()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->settings, $innerRenderer);
        $this->assertEmpty($renderer->render(['title' => 'bar']));
    }

    /**
     * @test
     */
    public function matchAllWhenMatchingOnlySome()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'all'], $innerRenderer);
        $this->assertEmpty($renderer->render(['title' => 'bar']));
    }

    /**
     * @test
     */
    public function matchAllWhenMatchingAll()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'all'], $innerRenderer);
        $this->assertEquals($value, $renderer->render(['title' => 'bar', 'author' => 'quux']));
    }

    /**
     * @test
     */
    public function matchAnyWhenMatchingSome()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'any'], $innerRenderer);
        $this->assertEquals($value, $renderer->render(['title' => 'bar']));
    }

    /**
     * @test
     */
    public function matchAnyWhenMatchingNone()
    {
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'any'], $innerRenderer);
        $this->assertEmpty($renderer->render([]));
    }

    /**
     * @test
     */
    public function matchNoneWhenMatchingSome()
    {
        $innerRenderer = new ValueRenderer('foo');
        $renderer = new VariableConditionRenderer($this->settings + ['match' => 'none'], $innerRenderer);
        $this->assertEmpty($renderer->render(['title' => 'bar']));
    }
}
