<?php

namespace Yitznewton\Procslyte\Tests\Render\Conditional;

use Yitznewton\Procslyte\Render\Conditional\TypeConditionRenderer;
use Yitznewton\Procslyte\Render\Text\ValueRenderer;

class TypeConditionRendererTest extends \PHPUnit_Framework_TestCase
{
    private $settings = ['types' => ['book']];

    /**
     * @test
     */
    public function defaultMatchWhenMatchingAll()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new TypeConditionRenderer($this->settings, $innerRenderer);
        $this->assertEquals($value, $renderer->render(['type' => 'book']));
    }

    /**
     * @test
     */
    public function defaultMatchWhenMatchingNone()
    {
        $value = 'foo';
        $innerRenderer = new ValueRenderer($value);
        $renderer = new TypeConditionRenderer($this->settings, $innerRenderer);
        $this->assertEmpty($renderer->render([]));
    }
}
