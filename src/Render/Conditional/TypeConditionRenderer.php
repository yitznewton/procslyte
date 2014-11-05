<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

class TypeConditionRenderer extends MatchingRenderer
{
    private $types;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     */
    public function __construct(array $settings, Renderer $innerRenderer)
    {
        parent::__construct($settings, $innerRenderer);
        $this->types = \igorw\get_in($settings, ['types']);
    }

    protected function citationDataMatchArray(array $citationData)
    {
        $callback = function () use ($citationData) {
            return in_array(\igorw\get_in($citationData, ['type']), $this->types, true);
        };

        return array_map($callback, $this->types);
    }
}
