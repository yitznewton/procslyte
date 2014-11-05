<?php

namespace Yitznewton\Procslyte\Render\Conditional;

use Yitznewton\Procslyte\Render\Renderer;

abstract class MultipleMatchRenderer implements Renderer
{
    const MATCH_ALL = 'all';
    const MATCH_ANY = 'any';
    const MATCH_NONE = 'none';
    const MATCH_DEFAULT = self::MATCH_ALL;

    private $match;
    private $innerRenderer;

    /**
     * @param array $settings
     * @param Renderer $innerRenderer
     */
    public function __construct(array $settings, Renderer $innerRenderer)
    {
        $this->match = \igorw\get_in($settings, ['match'], self::MATCH_DEFAULT);
        $this->innerRenderer = $innerRenderer;
    }

    /**
     * @param array $citationData
     * @return array
     */
    abstract protected function citationDataMatchArray(array $citationData);

    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $allMatches = $this->citationDataMatchArray($citationData);

        if ($this->foldMatch($allMatches)) {
            return $this->innerRenderer->render($citationData);
        } else {
            return '';
        }
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
