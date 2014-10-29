<?php

namespace Yitznewton\Procslyte;

class SimpleXMLElement extends \SimpleXMLElement
{
    /**
     * @param callable $callback
     * @param mixed $returnValue
     * @return mixed
     */
    public function reduce(callable $callback, $returnValue = null)
    {
        $isFirstIteration = true;

        foreach ($this as $item) {
            $castItem = $item->cast();

            if ($isFirstIteration && is_null($returnValue)) {
                $returnValue = $castItem;
            }

            $returnValue = $callback($returnValue, $castItem);
            $isFirstIteration = false;
        }

        return $returnValue;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function cast()
    {
        return (string) $this;
    }
}
