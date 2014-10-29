<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\Text\TermRenderer;
use Yitznewton\Procslyte\TermSet;

class TermRendererTest extends \PHPUnit_Framework_TestCase
{
    private $termSet;

    public function setUp()
    {
        $this->termSet = (object) [
            'foo' => [
                [
                    'form' => 'long',
                    'value' => 'Foo',
                    'valueMultiple' => 'Fooii',
                ],
                [
                    'form' => 'verb',
                    'value' => 'Fooing',
                ],
            ],
        ];
    }

    public function testWithMissingTerm()
    {
        $this->setExpectedException('\\Yitznewton\\Procslyte\\UndefinedIndexException');
        $termSet = new \stdClass();
        new TermRenderer('foo', $termSet);
    }

    public function testWithMissingValue()
    {
        $this->setExpectedException('\\Yitznewton\\Procslyte\\InvalidTermException');
        $termSet = (object) ['foo' => [['bar' => 'baz']]];
        $renderer = new TermRenderer('foo', $termSet);
        $renderer->render([]);
    }

    public function testWithDefaults()
    {
        $renderer = new TermRenderer('foo', $this->termSet);
        $this->assertEquals('Foo', $renderer->render([]));
    }

    public function testWithNonexistentForm()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['form' => 'short']);
        $this->assertEquals('Foo', $renderer->render([]));
    }

    public function testWithForm()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['form' => 'verb']);
        $this->assertEquals('Fooing', $renderer->render([]));
    }

    public function testWithPlural()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['plural' => true]);
        $this->assertEquals('Fooii', $renderer->render([]));
    }
}
