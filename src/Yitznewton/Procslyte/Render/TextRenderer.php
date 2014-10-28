<?php

namespace Yitznewton\Procslyte\Render;

use Yitznewton\Procslyte\UndefinedIndexException;

class TextRenderer implements Renderer
{
    private $variable;
    private $form;
    private $value;

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->variable = \igorw\get_in($settings, ['variable']);
        $this->form = \igorw\get_in($settings, ['form']);
        $this->value = \igorw\get_in($settings, ['value']);
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        if ($this->value) {
            return $this->value;
        }

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
