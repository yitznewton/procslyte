<?php

namespace Yitznewton\Procslyte\Tests\Render;

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

    /**
     * @test
     */
    public function withMissingTerm()
    {
        $this->setExpectedException('\\Yitznewton\\Procslyte\\UndefinedIndexException');
        $termSet = new \stdClass();
        new TermRenderer('foo', $termSet);
    }

    /**
     * @test
     */
    public function withMissingValue()
    {
        $this->setExpectedException('\\Yitznewton\\Procslyte\\InvalidTermException');
        $termSet = (object) ['foo' => [['bar' => 'baz']]];
        $renderer = new TermRenderer('foo', $termSet);
        $renderer->render([]);
    }

    /**
     * @test
     */
    public function withDefaults()
    {
        $renderer = new TermRenderer('foo', $this->termSet);
        $this->assertEquals('Foo', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withNonexistentForm()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['form' => 'short']);
        $this->assertEquals('Foo', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withForm()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['form' => 'verb']);
        $this->assertEquals('Fooing', $renderer->render([]));
    }

    /**
     * @test
     */
    public function withPlural()
    {
        $renderer = new TermRenderer('foo', $this->termSet, ['plural' => true]);
        $this->assertEquals('Fooii', $renderer->render([]));
    }
}
