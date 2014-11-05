<?php

namespace Yitznewton\Procslyte\Render\Group;

use Yitznewton\Procslyte\Render\Renderer;

class GroupRenderer implements Renderer, VariableUsageSubscriber
{
    private $delimiter;
    private $innerRenderers = [];
    private $emptyVariables = 0;
    private $nonemptyVariables = 0;

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
        $render = implode($this->delimiter, array_map(function ($renderer) use ($citationData) {
            return $renderer->render($citationData);
        }, $this->innerRenderers));

        if ($this->variablesAndAllEmpty()) {
            return '';
        } else {
            return $render;
        }
    }

    /**
     * @param Renderer $renderer
     */
    public function addInnerRenderer(Renderer $renderer)
    {
        $this->innerRenderers[] = $renderer;
    }

    public function registerEmptyVariable()
    {
        $this->emptyVariables++;
    }

    public function registerNonemptyVariable()
    {
        $this->nonemptyVariables++;
    }

    private function variablesAndAllEmpty()
    {
        return $this->emptyVariables != 0 && $this->nonemptyVariables === 0;
    }
}
