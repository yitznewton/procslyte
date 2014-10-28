<?php

namespace Yitznewton\Procslyte\Render\TextCase;

use Yitznewton\Procslyte\Render\Renderer;

class SentenceCaseRenderer extends MultiwordCaseRenderer implements Renderer
{
    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        $internalString = $this->innerRenderer->render($citationData);

        if ($this->isAllUpper($internalString)) {
            return ucfirst(strtolower($internalString));
        } elseif ($this->firstWordIsLower($internalString)) {
            return ucfirst(strtolower($internalString));
        } else {
            return $internalString;
        }
    }

    private function firstWordIsLower($internalString)
    {
        return $this->isAllLower($this->words($internalString)[0]);
    }
}
