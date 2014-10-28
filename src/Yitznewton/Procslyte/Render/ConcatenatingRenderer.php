<?php

namespace Yitznewton\Procslyte\Render;

class ConcatenatingRenderer implements Renderer
{
    private $subRenderers = [];

    /**
     * Use this method rather than passing an array of Renderers into the
     * constructor, so that we have type checking
     *
     * @param Renderer $subRenderer
     */
    public function push(Renderer $subRenderer)
    {
        $this->subRenderers[] = $subRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return implode(array_map(function ($renderer) use ($citationData) {
            return $renderer->render($citationData);
        }, $this->subRenderers));
    }
}
