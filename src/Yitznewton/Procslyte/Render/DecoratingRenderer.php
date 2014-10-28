<?php

namespace Yitznewton\Procslyte\Render;

abstract class DecoratingRenderer
{
    /**
     * @var array
     */
    protected $settings;
    /**
     * @var Renderer
     */
    protected $innerRenderer;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     */
    public function __construct(array $settings, Renderer $innerRenderer)
    {
        $this->settings = $settings;
        $this->innerRenderer = $innerRenderer;
    }
}
