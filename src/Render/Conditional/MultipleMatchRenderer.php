<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

abstract class MultipleMatchRenderer implements Renderer
{
    const MATCH_ALL = 'all';
    const MATCH_ANY = 'any';
    const MATCH_NONE = 'none';
    const MATCH_DEFAULT = self::MATCH_ALL;

    private $matchChoices;
    private $matchType;
    private $innerRenderer;

    /**
     * @param array $matchChoices
     * @param mixed $matchType
     * @param Renderer $innerRenderer
     */
    public function __construct(array $matchChoices, $matchType, Renderer $innerRenderer)
    {
        $this->matchChoices = $matchChoices;
        $this->matchType = $matchType;
        $this->innerRenderer = $innerRenderer;
    }

    /**
     * @param array $citationData
     * @param string $currentChoice
     * @return bool
     */
    abstract protected function citationMatches(array $citationData, $currentChoice);

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $allMatches = $this->matchArray($citationData);

        if ($this->foldMatch($allMatches)) {
            return $this->innerRenderer->render($citationData);
        } else {
            return '';
        }
    }

    private function matchArray(array $citationData)
    {
        $callback = function ($currentThing) use ($citationData) {
            return $this->citationMatches($citationData, $currentThing);
        };

        return array_map($callback, $this->matchChoices);
    }

    private function foldMatch(array $allResults)
    {
        switch ($this->matchType) {
            case self::MATCH_ALL:
                return !in_array(false, $allResults, true);
            case self::MATCH_ANY:
                return in_array(true, $allResults, true);
            case self::MATCH_NONE:
                return !in_array(true, $allResults, true);
            default:
                throw new \UnexpectedValueException('Unknown match type');
        }
    }
}
