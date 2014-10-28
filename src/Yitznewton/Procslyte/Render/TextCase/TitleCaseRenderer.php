<?php

namespace Yitznewton\Procslyte\Render\TextCase;

use Yitznewton\Procslyte\Render\Renderer;

class TitleCaseRenderer extends MultiwordCaseRenderer implements Renderer
{
    private static $stopWords = [
        'a',
        'an',
        'and',
        'as',
        'at',
        'but',
        'by',
        'down',
        'for',
        'from',
        'in',
        'into',
        'nor',
        'of',
        'on',
        'onto',
        'or',
        'over',
        'so',
        'the',
        'till',
        'to',
        'up',
        'via',
        'with',
        'yet',
    ];

    private $internalRenderer;

    /**
     * @param array $settings
     * @param Renderer $internalRenderer
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(array $settings, Renderer $internalRenderer)
    {
        $this->internalRenderer = $internalRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $internalString = $this->internalRenderer->render($citationData);

        if ($this->isAllUpper($internalString)) {
            return $this->renderUpper($internalString);
        } else {
            return $this->renderMixed($internalString);
        }
    }

    private function renderUpper($string)
    {
        return $this->renderString($string, 'renderUpperWord');
    }

    private function renderMixed($string)
    {
        return $this->renderString($string, 'renderMixedWord');
    }

    private function renderString($string, $method)
    {
        $initialString = implode(' ', $this->renderWords($string, $method));
        return $this->fixColonStopwords($initialString);
    }

    private function renderWords($string, $method)
    {
        return array_map([$this, $method], $this->words($string));
    }

    private function fixColonStopwords($string)
    {
        $callback = function ($matches) {
            if ($matches) {
                return $matches[1] . ucfirst($matches[2]);
            }
        };

        foreach (self::$stopWords as $stopWord) {
            $string = preg_replace_callback('/(:\s*)(' . $stopWord . ')/', $callback, $string);
        }

        return $string;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function renderUpperWord($word)
    {
        $lowerWord = strtolower($word);

        if (in_array($lowerWord, self::$stopWords)) {
            return $lowerWord;
        } else {
            return ucfirst($lowerWord);
        }
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function renderMixedWord($word)
    {
        if (!$this->isAllLower($word)) {
            return $word;
        }

        return $this->renderUpperWord($word);
    }
}