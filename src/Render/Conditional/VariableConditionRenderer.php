<?php

namespace Yitznewton\Procslyte\Render\Conditional;

class VariableConditionRenderer extends MultipleMatchRenderer
{
    protected function citationMatches(array $citationData, $currentChoice)
    {
        return isset($citationData[$currentChoice]);
    }
}
