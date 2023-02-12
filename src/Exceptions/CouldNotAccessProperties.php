<?php

namespace Fnp\Helper\Exceptions;

class CouldNotAccessProperties extends HelperException
{
    public static function make(object $model)
    {
        return new static(
            sprintf(
                'Could not access properties of model %s',
                get_class($model)
            )
        );
    }
}
