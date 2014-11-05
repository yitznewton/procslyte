<?php

namespace Yitznewton\Procslyte\Render\TextCase;

use Yitznewton\Procslyte\Render\DecoratingRenderer;
use Yitznewton\Procslyte\Render\Renderer;

class UppercaseRenderer extends DecoratingRenderer implements Renderer
{
    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return strtoupper($this->innerRenderer->render($citationData));
    }
}
