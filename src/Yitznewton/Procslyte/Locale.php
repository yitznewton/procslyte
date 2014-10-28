<?php

namespace Yitznewton\Procslyte;

class Locale
{
    /**
     * @var array
     */
    private $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function punctuationInQuote()
    {
        return \igorw\get_in($this->settings, ['styleOptions', 'punctuationInQuote'], false);
    }
}
