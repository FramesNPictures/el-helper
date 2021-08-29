<?php

namespace Fnp\ElHelper;

class Flg
{
    /**
     * Check if the given flag IS set withing the flag set.
     *
     * @param  int  $flagSet
     * @param  int  $flag
     *
     * @return bool
     */
    public static function has(int $flagSet, int $flag): bool
    {
        return (bool) (($flagSet & $flag) == $flag);
    }

    /**
     * Checks if the given flag IS NOT set withing the flag set.
     *
     * @param  int  $flagSet
     * @param  int  $flag
     *
     * @return bool
     */
    public static function not(int $flagSet, int $flag): bool
    {
        return !self::has($flagSet, $flag);
    }
}