<?php

namespace Yitznewton\Tests\Procslyte;

use Yitznewton\Procslyte\Render\TextRenderer;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testWithNonexistentVariable()
    {
        $this->setExpectedException('\Yitznewton\Procslyte\UndefinedIndexException');
        $renderer = new TextRenderer(['variable' => 'title']);
        $renderer->render([]);
    }

    public function testWithExistentVariable()
    {
        $title = 'Foo bar baz';
        $renderer = new TextRenderer(['variable' => 'title']);
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testWithExistentForm()
    {
        $title = 'Foo bar baz';
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);
        $this->assertEquals($title, $renderer->render(['title-short' => $title]));
    }

    public function testWithNonexistentForm()
    {
        $title = 'Foo bar baz';
        $renderer = new TextRenderer(['variable' => 'title', 'form' => 'short']);
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }

    public function testWithValue()
    {
        $value = 'foo';
        $renderer = new TextRenderer(['value' => $value]);
        $this->assertEquals($value, $renderer->render([]));
    }
}
