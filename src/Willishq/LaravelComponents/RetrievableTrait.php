<?php

namespace Willishq\LaravelComponents;

/**
 * Class ExtractableTrait
 *
 * Enables the retrieval of elements from an object.
 *
 * @package Willishq\LaravelComponents
 */
trait RetrievableTrait
{
    /**
     * @param   string  $type
     * @param   array   $keys
     * @return  array
     */
    private function retrieve($type, $keys)
    {
        if (count($keys)) {
            return call_user_func(['\Illuminate\Support\Arr', $type], (array) $this, $keys);
        }
        return (array) $this;

    }

    /**
     * Retrieve only the keys provided
     *
     * @param   string  $key,...    Unlimited optional variables of the keys to extract
     *
     * @return  array
     */
    public function retrieveOnly($key = null)
    {
        return $this->retrieve('only', func_get_args());
    }

    /**
     * Retrieve everything except the keys provided
     *
     * @param   string  $key,...    Unlimited optional variables of the keys to extract
     *
     * @return  array
     */
    public function retrieveExcept($key = null)
    {
        return $this->retrieve('except', func_get_args());
    }
} 