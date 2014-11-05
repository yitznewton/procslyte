<?php

namespace Yitznewton\Procslyte\Render;

class GroupRenderer implements Renderer
{
    private $delimiter;
    private $innerRenderers = [];

    public function __construct(array $settings = [])
    {
        $this->delimiter = \igorw\get_in($settings, ['delimiter']);
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return implode($this->delimiter, array_map(function ($renderer) use ($citationData) {
            return $renderer->render($citationData);
        }, $this->innerRenderers));
    }

    /**
     * @param Renderer $renderer
     */
    public function addInnerRenderer(Renderer $renderer)
    {
        $this->innerRenderers[] = $renderer;
    }
}
