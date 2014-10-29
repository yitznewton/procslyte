<?php

namespace Yitznewton\Procslyte;

class SimpleXMLElement extends \SimpleXMLElement
{
    /**
     * @param callable $callback
     * @return array
     */
    public function map(callable $callback)
    {
        $returnValue = [];

        foreach ($this as $item) {
            array_push($returnValue, $callback($item));
        }

        return $returnValue;
    }

    /**
     * @param callable $callback
     * @param mixed $returnValue
     * @return mixed
     */
    public function reduce(callable $callback, $returnValue = null)
    {
        $isFirstIteration = true;

        foreach ($this as $item) {
            if ($isFirstIteration && is_null($returnValue)) {
                $returnValue = $item;
            }

            $returnValue = $callback($returnValue, $item);
            $isFirstIteration = false;
        }

        return $returnValue;
    }
}
