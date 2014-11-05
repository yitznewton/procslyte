<?php

namespace Yitznewton\Procslyte\Tests\Render;

use Yitznewton\Procslyte\Render\Text\VariableRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class VariableRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function variableWhereNotExists()
    {
        $renderer = new VariableRenderer(['variable' => 'title']);

        $this->assertSame('', $renderer->render([]));
    }

    /**
     * @test
     */
    public function variableWhereExists()
    {
        $renderer = new VariableRenderer(['variable' => 'title']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    /**
     * @test
     */
    public function variableWithExistentForm()
    {
        $renderer = new VariableRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title-short' => $title]));
    }

    /**
     * @test
     */
    public function variableWithNonexistentForm()
    {
        $renderer = new VariableRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    /**
     * @test
     */
    public function value()
    {
        $value = 'foo';
        $renderer = new ValueRenderer($value);

        $this->assertEquals($value, $renderer->render([]));
    }
}
