<?php

namespace Yitznewton\Procslyte\Render\TextCase;

use Yitznewton\Procslyte\Render\DecoratingRenderer;

abstract class MultiwordCaseRenderer extends DecoratingRenderer
{
    /**
     * @param $string
     * @return array
     */
    protected function words($string)
    {
        return explode(' ', $string);
    }

    /**
     * @param string $string
     * @return bool
     */
    protected function isAllUpper($string)
    {
        return !preg_match('/[a-z]/', $string);
    }

    /**
     * @param string $string
     * @return bool
     */
    protected function isAllLower($string)
    {
        return !preg_match('/[A-Z]/', $string);
    }
}
