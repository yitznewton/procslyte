<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

class NumericVariableRenderer extends MultipleMatchRenderer implements Renderer
{
    /**
     * @param array $citationData
     * @param string $currentChoice
     * @return bool
     */
    protected function citationMatches(array $citationData, $currentChoice)
    {
        $currentValue = \igorw\get_in($citationData, [$currentChoice], null);

        if (!$currentValue) {
            return false;
        }

        return $this->allWordsNumeric($currentValue);
    }

    private function allWordsNumeric($value)
    {
        $words = explode(' ', $value);

        if (!$this->containsDigit($value)) {
            return false;
        }

        $wordIsNumeric = function ($cum, $word) {
            if ($cum === false) {
                return false;
            }

            if ($this->recognizedDelimiter($word)) {
                return true;
            }

            return $this->containsDigit($word);
        };

        return array_reduce($words, $wordIsNumeric, true);
    }

    private function containsDigit($value)
    {
        return preg_match('/\d/', $value) > 0;
    }

    private function recognizedDelimiter($current)
    {
        return in_array($current, ['&', '-', ',']);
    }
}
