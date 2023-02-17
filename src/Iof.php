<?php

namespace Fnp\ElHelper;

use Traversable;

class Iof
{
    private const COLLECTION_CLASSES = [
        'Illuminate\Support\Collection',
        'Illuminate\Database\Eloquent\Collection',
    ];

    /**
     * Can instance be converted to array?
     *
     * @param  mixed  $object  Object to be tested
     *
     * @return bool
     */
    public static function arrayable($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return method_exists($object, 'toArray');
    }

    /**
     * Can instance be converted to JSON?
     *
     * @param  mixed  $object  Object to be tested
     *
     * @return bool
     */
    public static function jsonable($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return method_exists($object, 'toJson');
    }

    /**
     * Can instance be converted to string?
     *
     * @param  mixed  $object  Object to be tested
     *
     * @return bool
     */
    public static function stringable($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return method_exists($object, '__toString');
    }

    /**
     * Is instance a collection?
     *
     * @param  mixed  $object  Object to be tested
     *
     * @return bool
     */
    public static function collection($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return in_array(
            get_class($object),
            self::COLLECTION_CLASSES
        );
    }

    /**
     * Is instance traversable
     *
     * @param  mixed  $object  Object or Array to be tested
     *
     * @return bool
     */
    public static function traversable($object): bool
    {
        if (is_array($object)) {
            return true;
        }

        if (!is_object($object)) {
            return false;
        }

        if ($object instanceof Traversable) {
            return true;
        }

        return false;
    }

    /**
     * Is instance an eloquent model?
     *
     * @param  mixed  $object  Object to be tested
     *
     * @return bool
     */
    public static function eloquentModel($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return method_exists($object, 'getRouteKeyName');
    }

    /**
     * Is instance serializable?
     *
     * @param $object
     *
     * @return bool
     */
    public static function serializable($object): bool
    {
        if (!is_object($object)) {
            return false;
        }

        return method_exists($object, '__serialize');
    }
}
