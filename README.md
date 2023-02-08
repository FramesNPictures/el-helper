# ElHelper

[![CircleCI](https://circleci.com/gh/FramesNPictures/el-helper/tree/develop.svg?style=svg)](https://circleci.com/gh/FramesNPictures/el-helper/tree/develop)

Number of helpers to be used in other modules.

The following helpers are currently in use:

| Class              | Description                                                                            |
|:-------------------|:---------------------------------------------------------------------------------------|
| `Fnp\ElHelper\Arr` | Extends the Laravel's Arr Object with hashing functionality.                           |
| `Fnp\ElHelper\Flg` | Binary flags manipulation library.                                                     |
| `Fnp\ElHelper\Iof` | Checks if the given object implements particular functionality.                        |
| `Fnp\ElHelper\Obj` | Object manipulation library.                                                           |
| `Fnp\ElHelper\Str` | String manipulation library. Adds support for some edge cases when converting strings. |

## Arr Helper

Introduces `hash` function that generates the same hash for the array with the same content.
It extends Laravel's Arr object.

## Flg Helper

Allows manipulation of binary flags. Allows to check for the given flag is enabled in integer value, as well as adding
and removing the values.

| Method  | Description                                           |
|:--------|:------------------------------------------------------|
| `has`   | Checks if the given flag exists in the flags value.   |
| `not`   | Check if the given flag is absent in the flags value. |
| `clear` | Removes the given flag from the flags value.          |
| `set`   | Sets the given flag in the flags value.               |

## Iof Helper

This helper checks if the given object implements the the particular
functionality. It does that in various way including checking
implemented interfaces, having a particular properties or methods
exposed.

| Method          | Description                                                          |
|:----------------|:---------------------------------------------------------------------|
| `arrayable`     | Does given object can be converted to array using `toArray` method?  |
| `jsonable`      | Does given object can be converted to JSON using `toJson` method?    |
| `stringable`    | Does given object can be casted to string?                           | 
| `collection`    | Does given object is a collection?                                   |                              
| `traversable`   | Does given object can be traversed using `foreach` method?           |
| `eloquentModel` | Does given object is an eloquent model?                              |
| `serializable`  | Can the given object be serialized using `__serialize` magic method? |

## Obj Helper

This helper allow the manipulation of the objects or reading certain properties of the given objects.

| Method         | Description                                                                                         |
|:---------------|:----------------------------------------------------------------------------------------------------|
| `properties`   | Retrieves the properties of the given object.                                                       |
| `key`          | Generates the unique key for the given value. It might be the object, array or any primitive value. |
| `methodName`   | Generates the method name string based on prefix, name and suffix.                                  |
| `methodExists` | Checks if the method generated based on prefix, name and suffix exists in a given object.           |

## Str Helper

This helper extends the Laravel's `Str` object and "fixes" few edge cases for the `camel` and `snake` methods.
Additionaly it introduces new `isAllCaps` methods. Please see the tests for additional edge cases covered.

