<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\Text\TextRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class TextRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testVariableWhereNotExists()
    {
        $renderer = new TextRenderer(['variable' => 'title']);

        $this->assertNull($renderer->render([]));
    }

    public function testVariableWhereExists()
    {
        $renderer = new TextRenderer(['variable' => 'title']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testVariableWithExistentForm()
    {
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title-short' => $title]));
    }

    public function testVariableWithNonexistentForm()
    {
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);

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
