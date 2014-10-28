<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\TextRenderer;

class TextRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testWithNonexistentVariable()
    {
        $renderer = new TextRenderer(['variable' => 'title']);

        $this->assertNull($renderer->render([]));
    }

    public function testWithExistentVariable()
    {
        $renderer = new TextRenderer(['variable' => 'title']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testWithExistentForm()
    {
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title-short' => $title]));
    }

    public function testWithNonexistentForm()
    {
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);

        $title = 'Foo bar baz';
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testWithValue()
    {
        $value = 'foo';
        $renderer = new TextRenderer(['value' => $value]);

        $this->assertEquals($value, $renderer->render([]));
    }
}
