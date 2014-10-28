<?php

namespace Yitznewton\Procslyte\Render\TextCase;

use Yitznewton\Procslyte\Render\Renderer;

class CapitalizeAllRenderer implements Renderer
{
    private $internalRenderer;

    /**
     * @param array $settings
     * @param Renderer $internalRenderer
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(array $settings, Renderer $internalRenderer)
    {
        $this->internalRenderer = $internalRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return ucwords($this->internalRenderer->render($citationData));
    }
}
