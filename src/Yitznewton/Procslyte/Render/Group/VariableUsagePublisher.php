<?php

namespace Yitznewton\Procslyte\Render\Group;

interface VariableUsagePublisher
{
    /**
     * @param VariableUsageSubscriber $subscriber
     */
    public function addVariableSubscriber(VariableUsageSubscriber $subscriber);
}
