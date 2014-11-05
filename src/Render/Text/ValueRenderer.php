<?php

namespace Yitznewton\Procslyte\Render\Text;

use Yitznewton\Procslyte\Render\Renderer;

class ValueRenderer implements Renderer
{
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param array $citationData
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function render(array $citationData)
    {
        return $this->value;
    }
}
