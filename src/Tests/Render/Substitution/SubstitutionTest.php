<?php

namespace Yitznewton\Procslyte\Tests\Render\Substitution;

use Yitznewton\Procslyte\Render\Substitution\SubstitutableRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class SubstitutionTest extends \PHPUnit_Framework_TestCase
{
    private $listener;

    public function setUp()
    {
        $this->listener = new SpySubstitutionListener();
    }

    private function createRenderer($value)
    {
        $defaultRenderer = new ValueRenderer($value);
        return new SubstitutableRenderer($defaultRenderer, $this->listener);
    }

    /**
     * @test
     */
    public function withDefaultReturn()
    {
        $defaultValue = 'foo';
        $renderer = $this->createRenderer($defaultValue);

        $renderedResult = $renderer->render([]);

        $this->assertEquals($defaultValue, $renderedResult);
        $this->assertFalse($this->listener->receivedEvent());
    }

    /**
     * @test
     */
    public function withAllEmpty()
    {
        $renderer = $this->createRenderer('');
        $blankRenderer = new ValueRenderer('');
        $renderer->addSubstitute('blank', $blankRenderer);

        $renderedResult = $renderer->render([]);

        $this->assertSame('', $renderedResult);
        $this->assertFalse($this->listener->receivedEvent());
    }

    /**
     * @test
     */
    public function withSecondarySubstituteReturn()
    {
        $renderer = $this->createRenderer('');

        $blankRenderer = new ValueRenderer('');
        $renderer->addSubstitute('blank', $blankRenderer);

        $substituteName = 'title';
        $substituteValue = 'bar';
        $titleRenderer = new ValueRenderer($substituteValue);
        $renderer->addSubstitute($substituteName, $titleRenderer);

        $renderedResult = $renderer->render([]);

        $this->assertEquals($substituteValue, $renderedResult);
        $this->assertTrue($this->listener->receivedEvent());
        $this->assertEquals($substituteName, $this->listener->getEvent()->getNameOfSubstitute());
    }
}
