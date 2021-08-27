<?php

namespace Fnp\ElHelper;

use stdClass;

class Obj
{
    /**
     * Checks if method exists in the current model.
     * Returns method name if it does or NULL otherwise.
     *
     * @param        $object
     * @param string $prefix
     * @param string $name
     * @param string $suffix
     *
     * @return null|string
     */
    public static function methodExists($object, $prefix, $name, $suffix = NULL)
    {
        $method = static::methodName($prefix, $name, $suffix);

        return method_exists($object, $method) ? $method : NULL;
    }

    /**
     * Builds a method name based on prefix, name and suffix
     *
     * @param string $prefix
     * @param string $name
     * @param string $suffix
     *
     * @return string
     */
    public static function methodName($prefix, $name, $suffix = NULL)
    {
        $name = str_replace([' ', '-', '.'], '_', $name);

        if (Str::contains($name, '_') || Str::isAllCaps($name)) {
            $name = strtolower($name);
        }

        $elPrefix = $prefix;
        $elName = ucfirst(Str::camel($name));
        $elSuffix = $suffix;

        if (empty($prefix)) {
            $elPrefix = NULL;
            $elName = Str::camel($name);
        }

        if ($suffix) {
            $elSuffix = ucFirst($suffix);
        }

        $method = $elPrefix . $elName . $elSuffix;

        return $method;
    }

    public static function key(...$dependencies)
    {
        $key = [];

        foreach ($dependencies as $dependency) {

            if (is_string($dependency)) {
                $dependency = sha1($dependency);
            }

            if (Iof::eloquentModel($dependency)) {
                $dependency = sprintf(
                    '[%s-%s]',
                    get_class($dependency),
                    $dependency->getAttribute($dependency->getRouteKeyName())
                );
            }

            if (Iof::arrayable($dependency)) {
                $dependency = Arr::hash($dependency->toArray());
            }

            if (Iof::jsonable($dependency)) {
                $dependency = sha1($dependency->toJson());
            }

            if ($dependency instanceof stdClass) {
                $dependency = Arr::hash(get_object_vars($dependency));
            }

            if (is_object($dependency)) {
                $dependency = Arr::hash(get_object_vars($dependency));
            }

            if (is_array($dependency)) {
                $dependency = Arr::hash($dependency);
            }

            $key[] = $dependency;
        }

        return hash('sha256', implode('-', $key));
    }
}