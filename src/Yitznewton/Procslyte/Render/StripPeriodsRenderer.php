<?php

namespace Yitznewton\Procslyte\Render;

class StripPeriodsRenderer extends DecoratingRenderer implements Renderer
{
    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData)
    {
        return str_replace('.', '', $this->innerRenderer->render($citationData));
    }
}
