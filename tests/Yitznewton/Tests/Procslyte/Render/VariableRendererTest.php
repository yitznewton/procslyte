<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\Text\VariableRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class VariableRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testVariableWhereNotExists()
    {
        $renderer = new VariableRenderer(['variable' => 'title']);

        $this->assertSame('', $renderer->render([]));
    }

    public function testVariableWhereExists()
    {
        $renderer = new VariableRenderer(['variable' => 'title']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testVariableWithExistentForm()
    {
        $renderer = new VariableRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title-short' => $title]));
    }

    public function testVariableWithNonexistentForm()
    {
        $renderer = new VariableRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testValue()
    {
        $value = 'foo';
        $renderer = new ValueRenderer($value);

        $this->assertEquals($value, $renderer->render([]));
    }
}
