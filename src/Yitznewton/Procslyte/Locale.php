<?php

namespace Yitznewton\Procslyte;

class Locale
{
    private $settings;

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return bool
     */
    public function punctuationInQuote()
    {
        return \igorw\get_in($this->settings, ['styleOptions', 'punctuationInQuote'], false);
    }
}
