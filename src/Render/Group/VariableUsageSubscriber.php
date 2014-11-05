<?php

namespace Yitznewton\Procslyte\Render\Group;

interface VariableUsageSubscriber
{
    public function registerEmptyVariable();
    public function registerNonemptyVariable();
}
