<?php

namespace Fnp\ElHelper;

class Str extends \Illuminate\Support\Str
{
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

    public static function camel($value)
    {
        if (static::isAllCaps($value)) {
            $value = strtolower($value);
        }

        $camel = parent::camel($value);

        return $camel;
    }

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