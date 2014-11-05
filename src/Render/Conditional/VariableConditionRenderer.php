<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

class VariableConditionRenderer extends MultipleMatchRenderer
{
    private $variables;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     */
    public function __construct(array $settings, Renderer $innerRenderer)
    {
        parent::__construct($settings, $innerRenderer);
        $this->variables = \igorw\get_in($settings, ['variables']);
    }

    protected function citationDataMatchArray(array $citationData)
    {
        $callback = function ($currentVariableName) use ($citationData) {
            return isset($citationData[$currentVariableName]);
        };

        return array_map($callback, $this->variables);
    }
}
