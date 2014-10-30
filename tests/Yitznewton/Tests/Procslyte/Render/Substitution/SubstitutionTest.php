<?php

namespace Yitznewton\Tests\Procslyte\Render\Substitution;

use Yitznewton\Procslyte\Render\Substitution\SubstitutableRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class SubstitutionTest extends \PHPUnit_Framework_TestCase
{
    public function testWithDefaultReturn()
    {
        $defaultValue = 'foo';
        $defaultRenderer = new ValueRenderer($defaultValue);
        $listener = new SpySubstitutionListener();
        $renderer = new SubstitutableRenderer($defaultRenderer, $listener);
        $this->assertEquals($defaultValue, $renderer->render([]));
        $this->assertFalse($listener->receivedEvent());
    }

    public function testWithAllEmpty()
    {
        $defaultRenderer = new ValueRenderer('');
        $listener = new SpySubstitutionListener();
        $renderer = new SubstitutableRenderer($defaultRenderer, $listener);
        $renderer->addSubstitute('blank', $defaultRenderer);
        $this->assertSame('', $renderer->render([]));
        $this->assertFalse($listener->receivedEvent());
    }

    public function testWithSecondarySubstituteReturn()
    {
        $defaultRenderer = new ValueRenderer('');

        $listener = new SpySubstitutionListener();
        $renderer = new SubstitutableRenderer($defaultRenderer, $listener);

        $blankRenderer = new ValueRenderer('');

        $substituteName = 'title';
        $substituteValue = 'bar';
        $titleRenderer = new ValueRenderer($substituteValue);

        $renderer->addSubstitute('blank', $blankRenderer);
        $renderer->addSubstitute($substituteName, $titleRenderer);

        $this->assertEquals($substituteValue, $renderer->render([]));
        $this->assertTrue($listener->receivedEvent());
        $this->assertEquals($substituteName, $listener->getEvent()->getNameOfSubstitute());
    }
}
