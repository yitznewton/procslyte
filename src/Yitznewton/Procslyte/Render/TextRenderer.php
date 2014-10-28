<?php

namespace Yitznewton\Procslyte\Render;

use Yitznewton\Procslyte\UndefinedIndexException;

class TextRenderer
{
    private $variable;
    private $form;

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->variable = \igorw\get_in($settings, ['variable']);
        $this->form = \igorw\get_in($settings, ['form']);
    }

    public function render(array $citationData)
    {
        $variableNameWithForm = sprintf('%s-%s', $this->variable, $this->form);
        if ($this->form && isset($citationData[$variableNameWithForm])) {
            return $citationData[$variableNameWithForm];
        }

        if (empty($citationData[$this->variable])) {
            throw new UndefinedIndexException();
        }

        return $citationData[$this->variable];
    }
}
