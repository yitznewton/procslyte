<?php

namespace Yitznewton\Procslyte\Render;

use Yitznewton\Procslyte\Locale;

class QuotesRenderer implements Renderer
{
    const QUOTE_CHARACTER = '"';

    private $innerRenderer;
    private $locale;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     * @param Locale $locale
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(array $settings, Renderer $innerRenderer, Locale $locale)
    {
        $this->innerRenderer = $innerRenderer;
        $this->locale = $locale;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $innerValue = $this->innerRenderer->render($citationData);

        if (!$this->locale->punctuationInQuote()) {
            return $this->quoteWithinPunctuation($innerValue);
        } else {
            return $this->quote($innerValue);
        }
    }

    private function quoteWithinPunctuation($innerValue)
    {
        $lastCharacter = substr($innerValue, -1);

        if ($this->isPunctuation($lastCharacter)) {
            return $this->quote(substr($innerValue, 0, -1)) . substr($innerValue, -1);
        } else {
            return $this->quote($innerValue);
        }
    }

    /**
     * @param $innerValue
     * @return string
     */
    private function quote($innerValue)
    {
        return sprintf('%s%s%s', self::QUOTE_CHARACTER, $innerValue, self::QUOTE_CHARACTER);
    }

    /**
     * @param $lastCharacter
     * @return bool
     */
    private function isPunctuation($lastCharacter)
    {
        $punctuationChars = ['.', ','];

        return in_array($lastCharacter, $punctuationChars);
    }
}
