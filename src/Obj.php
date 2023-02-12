<?php

namespace Fnp\Helper;

use Fnp\Helper\Exceptions\CouldNotAccessProperties;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use stdClass;

class Obj
{
    const PROPERTIES_ALL        = ReflectionProperty::IS_PUBLIC +
                                  ReflectionProperty::IS_PROTECTED +
                                  ReflectionProperty::IS_PRIVATE;
    const PROPERTIES_PUBLIC     = ReflectionProperty::IS_PUBLIC;
    const PROPERTIES_PROTECTED  = ReflectionProperty::IS_PROTECTED;
    const PROPERTIES_PRIVATE    = ReflectionProperty::IS_PRIVATE;
    const PROPERTIES_ACCESSIBLE = ReflectionProperty::IS_PUBLIC +
                                  ReflectionProperty::IS_PROTECTED;

    /**
     * Checks if method exists in the current model.
     * Returns method name if it does or NULL otherwise.
     *
     * @param          $object
     * @param  string  $prefix
     * @param  string  $name
     * @param  string  $suffix
     *
     * @return null|string
     */
    public static function methodExists($object, $prefix, $name, $suffix = null)
    {
        $method = static::methodName($prefix, $name, $suffix);

        return method_exists($object, $method) ? $method : null;
    }

    /**
     * Builds a method name based on prefix, name and suffix
     *
     * @param  string  $prefix
     * @param  string  $name
     * @param  string  $suffix
     *
     * @return string
     */
    public static function methodName($prefix, $name, $suffix = null)
    {
        $name = str_replace([' ', '-', '.'], '_', $name);

        if (Str::contains($name, '_') || Str::isAllCaps($name)) {
            $name = strtolower($name);
        }

        $elPrefix = $prefix;
        $elName   = ucfirst(Str::camel($name));
        $elSuffix = $suffix;

        if (empty($prefix)) {
            $elPrefix = null;
            $elName   = Str::camel($name);
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

    /**
     * Retrieves properties of the object
     *
     * @param  mixed  $model  Model object
     * @param  int    $flags  Additional flags
     *
     * @return ReflectionProperty[]|array
     */
    public static function properties(mixed $model, int $flags = self::PROPERTIES_ALL): array
    {
        try {
            $reflection = new ReflectionClass($model);
        } catch (ReflectionException $e) {
            throw CouldNotAccessProperties::make($model);
        }

        return $reflection->getProperties($flags);
    }
}
