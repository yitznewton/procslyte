<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

class VariableConditionRenderer implements Renderer
{
    const MATCH_ALL = 'all';
    const MATCH_ANY = 'any';
    const MATCH_NONE = 'none';
    const MATCH_DEFAULT = self::MATCH_ALL;

    private $variables;
    private $match;
    private $innerRenderer;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     */
    public function __construct(array $settings, Renderer $innerRenderer)
    {
        $this->variables = \igorw\get_in($settings, ['variables']);
        $this->match = \igorw\get_in($settings, ['match'], self::MATCH_DEFAULT);
        $this->innerRenderer = $innerRenderer;
    }

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        if ($this->citationDataMatches($citationData)) {
            return $this->innerRenderer->render($citationData);
        } else {
            return '';
        }
    }

    private function citationDataMatches(array $citationData)
    {
        $callback = function ($currentVariableName) use ($citationData) {
            return isset($citationData[$currentVariableName]);
        };

        $allMatchResults = array_map($callback, $this->variables);

        return $this->foldMatch($allMatchResults);
    }

    private function foldMatch(array $allResults)
    {
        switch ($this->match) {
            case self::MATCH_ALL:
                return !in_array(false, $allResults, true);
            case self::MATCH_ANY:
                return in_array(true, $allResults, true);
            case self::MATCH_NONE:
                return !in_array(true, $allResults, true);
            default:
                throw new \UnexpectedValueException();
        }
    }
}
