<?php

namespace Yitznewton\Procslyte\Render;

class AffixRenderer implements Renderer
{
    private $internalRenderer;
    private $prefix;

    public function __construct(array $settings, Renderer $internalRenderer)
    {
        $this->prefix = \igorw\get_in($settings, ['prefix'], '');
        $this->suffix = \igorw\get_in($settings, ['suffix'], '');
        $this->internalRenderer = $internalRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return $this->prefix . $this->internalRenderer->render($citationData) . $this->suffix;
    }
}
