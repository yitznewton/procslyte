<?php

namespace Yitznewton\Procslyte\Render;

interface Renderer
{
    /**
     * @param array $citationData
     * @return string
     */
    public function render(array $citationData);
}
