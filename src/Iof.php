<?php

namespace Fnp\ElHelper;

class Iof
{
    /**
     * Can instance be converted to array?
     *
     * @param $object
     *
     * @return bool
     */
    public static function arrayable($object)
    {
        if (!is_object($object))
            return FALSE;

        return method_exists($object, 'toArray');
    }

    /**
     * Can instance be converted to JSON?
     *
     * @param $object
     *
     * @return bool
     */
    public static function jsonable($object)
    {
        if (!is_object($object))
            return FALSE;

        return method_exists($object, 'toJson');
    }

    /**
     * Can instance be converted to string?
     *
     * @param $object
     *
     * @return bool
     */
    public static function stringable($object)
    {
        if (!is_object($object))
            return FALSE;

        return method_exists($object, '__toString');
    }

    /**
     * Is instance a collection?
     *
     * @param $object
     *
     * @return bool
     */
    public static function collection($object)
    {
        if (!is_object($object))
            return FALSE;

        return method_exists($object, 'contains') &&
               method_exists($object, 'push') &&
               method_exists($object, 'tap');
    }

    /**
     * Is instance an eloquent model?
     *
     * @param $object
     *
     * @return bool
     */
    public static function eloquentModel($object)
    {
        if (!is_object($object))
            return FALSE;

        return method_exists($object, 'getRouteKeyName');
    }
}