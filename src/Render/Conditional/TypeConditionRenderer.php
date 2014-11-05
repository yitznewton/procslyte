<?php

namespace Yitznewton\Procslyte\Render\Conditional;

class TypeConditionRenderer extends MultipleMatchRenderer
{
    protected function citationMatches(array $citationData, $currentChoice)
    {
        return \igorw\get_in($citationData, ['type']) === $currentChoice;
    }
}
