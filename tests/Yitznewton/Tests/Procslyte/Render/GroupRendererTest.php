<?php

namespace Yitznewton\Tests\Procslyte\Render;

use Yitznewton\Procslyte\Render\Group\GroupRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;
use Yitznewton\Procslyte\Render\Text\VariableRenderer;

class GroupRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function withChildRenderers()
    {
        $firstValue = 'a';
        $secondValue = 'b';

        $renderer = new GroupRenderer();
        $renderer->addInnerRenderer(new ValueRenderer($firstValue));
        $renderer->addInnerRenderer(new ValueRenderer($secondValue));

        $this->assertEquals($firstValue . $secondValue, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withDelimiterAndTwoChildRenderers()
    {
        $firstValue = 'a';
        $secondValue = 'b';
        $delimiter = '_';

        $renderer = new GroupRenderer(['delimiter' => $delimiter]);
        $renderer->addInnerRenderer(new ValueRenderer($firstValue));
        $renderer->addInnerRenderer(new ValueRenderer($secondValue));

        $this->assertEquals($firstValue . $delimiter . $secondValue, $renderer->render([]));
    }

    /**
     * @test
     */
    public function withNonemptyVariableNotification()
    {
        $innerRenderer = new VariableRenderer(['variable' => 'title']);

        $groupRenderer = new GroupRenderer();
        $groupRenderer->addInnerRenderer(new VariableRenderer(['variable' => 'title']));
        $innerRenderer->addVariableSubscriber($groupRenderer);

        $title = 'foo';
        $this->assertEquals($title, $groupRenderer->render(['title' => $title]));
    }

    /**
     * @test
     */
    public function withEmptyVariableNotification()
    {
        $variableRenderer = new VariableRenderer(['variable' => 'title']);

        $groupRenderer = new GroupRenderer();
        $groupRenderer->addInnerRenderer(new ValueRenderer('foo'));
        $groupRenderer->addInnerRenderer($variableRenderer);
        $variableRenderer->addVariableSubscriber($groupRenderer);

        $this->assertEmpty($groupRenderer->render([]));
    }
}
