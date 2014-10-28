<?php

namespace Yitznewton\Procslyte\Render;

class PrefixRenderer implements Renderer
{
    private $internalRenderer;
    private $prefix;

    public function __construct(array $settings, Renderer $internalRenderer)
    {
        $this->prefix = \igorw\get_in($settings, ['prefix'], '');
        $this->internalRenderer = $internalRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return $this->prefix . $this->internalRenderer->render($citationData);
    }
}
