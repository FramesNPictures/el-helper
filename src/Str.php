<?php

namespace Fnp\ElHelper;

class Str extends \Illuminate\Support\Str
{
    /**
     * Convert to camelCase
     *
     * @param $value
     * @return mixed
     */
    public static function camel($value)
    {
        if (static::isAllCaps($value)) {
            $value = strtolower($value);
        }

        $camel = parent::camel($value);

        return $camel;
    }

    /**
     * Checks if a given string value is all capital
     *
     * @param $value
     *
     * @return bool
     */
    public static function isAllCaps($value)
    {
        return strtoupper($value) == $value;
    }

    /**
     * Converts to snake_case
     * @param $value
     * @param string $delimiter
     * @return mixed
     */
    public static function snake($value, $delimiter = '_')
    {
        if (static::isAllCaps($value)) {
            $value = strtolower($value);
        }

        $value = preg_replace('/([0-9]+)/', '_$1', $value);
        $value = str_replace($delimiter . $delimiter, $delimiter, $value);
        $value = str_replace($delimiter . $delimiter, $delimiter, $value);

        $snake = parent::snake($value, $delimiter);

        return $snake;
    }
}