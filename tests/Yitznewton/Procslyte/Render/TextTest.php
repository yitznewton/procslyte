<?php

namespace Yitznewton\Tests\Procslyte;

use Yitznewton\Procslyte\Render\TextRenderer;
use Yitznewton\Procslyte\UndefinedIndexException;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testWithNonexistentVariable()
    {
        $this->setExpectedException(UndefinedIndexException::class);
        $renderer = new TextRenderer(['variable' => 'title']);
        $renderer->render([]);
    }

    public function testWithExistentVariable()
    {
        $title = 'Foo bar baz';
        $renderer = new TextRenderer(['variable' => 'title']);
        $this->assertEquals($title, $renderer->render(['title' => $title]));
    }
}
