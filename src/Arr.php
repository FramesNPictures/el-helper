<?php

namespace Fnp\Helper;

use Illuminate\Support\Arr as IlluminateArr;

class Arr extends IlluminateArr
{
    public static function hash($arr)
    {
        $arr = self::flatten($arr);

        ksort($arr);

        return sha1(json_encode($arr));
    }
}
