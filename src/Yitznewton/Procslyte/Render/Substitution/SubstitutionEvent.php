<?php

namespace Yitznewton\Procslyte\Render\Substitution;

class SubstitutionEvent
{
    private $nameOfSubstitute;

    /**
     * @param string $nameOfSubstitute
     */
    public function __construct($nameOfSubstitute)
    {
        $this->nameOfSubstitute = $nameOfSubstitute;
    }

    public function getNameOfSubstitute()
    {
        return $this->nameOfSubstitute;
    }
}
