<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

class IfElseRenderer implements Renderer
{
    /** @var Renderer[] */
    private $conditionalRenderers = [];

    /** @var Renderer */
    private $defaultRenderer;

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $fromConditional = $this->fromConditionalRenderers($citationData);

        if ($fromConditional) {
            return $fromConditional;
        }

        if ($this->defaultRenderer) {
            return $this->defaultRenderer->render($citationData);
        }

        return '';
    }

    /**
     * @param Renderer $renderer
     */
    public function addConditionalRenderer(Renderer $renderer)
    {
        $this->conditionalRenderers[] = $renderer;
    }

    /**
     * @param Renderer $renderer
     */
    public function setDefaultRenderer(Renderer $renderer)
    {
        $this->defaultRenderer = $renderer;
    }

    private function fromConditionalRenderers(array $citationData)
    {
        $callback = function ($cum, $current) use ($citationData) {
            if ($cum) {
                return $cum;
            }

            return $current->render($citationData);
        };

        return array_reduce($this->conditionalRenderers, $callback, '');
    }
}
