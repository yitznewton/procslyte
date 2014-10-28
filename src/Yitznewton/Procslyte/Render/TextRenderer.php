<?php

namespace Yitznewton\Procslyte\Render;

use Yitznewton\Procslyte\UndefinedIndexException;

class TextRenderer
{
    private $variable;

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->variable = \igorw\get_in($settings, ['variable']);
    }

    public function render(array $citationData)
    {
        if (empty($citationData[$this->variable])) {
            throw new UndefinedIndexException();
        }

        return $citationData[$this->variable];
    }
}
