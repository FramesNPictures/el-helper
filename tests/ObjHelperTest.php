<?php

use Fnp\ElHelper\Obj;
use PHPUnit\Framework\TestCase;

class ObjHelperTest extends TestCase
{
    public function provideMethodNamesTestData()
    {
        return [
            'All Lower Case'              => [
                'get',
                'name',
                null,
                'getName',
            ],
            'All Lower Case with Suffix'  => [
                'get',
                'name',
                'attribute',
                'getNameAttribute',
            ],
            'All Lower without Prefix'    => [
                '',
                'name',
                'attribute',
                'nameAttribute',
            ],
            'Snake Case Name'             => [
                'fill',
                'post_code',
                null,
                'fillPostCode',
            ],
            'Snake Case Name with Suffix' => [
                'fill',
                'post_code',
                'Value',
                'fillPostCodeValue',
            ],
            'Snake Case without Prefix'   => [
                null,
                'post_code',
                'Value',
                'postCodeValue',
            ],
            'Upper Case Name'             => [
                'fill',
                'POST_CODE',
                null,
                'fillPostCode',
            ],
            'Upper Case with Suffix'      => [
                'fill',
                'POST_CODE',
                'attributeValue',
                'fillPostCodeAttributeValue',
            ],
            'Upper Case without Prefix'   => [
                '',
                'POST_CODE',
                'value',
                'postCodeValue',
            ],
            'Upper Case with Prefix'      => [
                'get',
                'POST_CODE',
                'value',
                'getPostCodeValue',
            ],
            'Upper Case one Word'         => [
                'get',
                'VALUES',
                null,
                'getValues',
            ],
            'Just Name Upper'             => [
                null,
                'VALUES',
                null,
                'values',
            ],
            'Just Name Lower'             => [
                null,
                'values',
                null,
                'values',
            ],
            'Just Name Snake'             => [
                null,
                'post_code',
                null,
                'postCode',
            ],
            'Just Name Camel'             => [
                null,
                'postCode',
                null,
                'postCode',
            ],
            'Dot Separated'               => [
                'set',
                'dot.separated.value',
                null,
                'setDotSeparatedValue',
            ],
            'Dash Separated'              => [
                '',
                'dash-separated-value',
                'Attribute',
                'dashSeparatedValueAttribute',
            ],
        ];
    }

    /**
     * @test
     *
     * @param $prefix
     * @param $name
     * @param $suffix
     * @param $methodName
     *
     * @dataProvider provideMethodNamesTestData
     */
    public function testMethodNames($prefix, $name, $suffix, $methodName)
    {
        $this->assertEquals($methodName, Obj::methodName($prefix, $name, $suffix));
    }

    public function testAccessingProperties()
    {
        // Object
        $object = new class {
            public    $name    = 'John';
            protected $surname = 'Doe';
            private   $email   = 'john.doe@gmail.com';
        };

        // All properties
        $props = Obj::properties($object, Obj::PROPERTIES_ALL);
        $this->assertEquals(3, count($props));

        // Public properties
        $props = Obj::properties($object, Obj::PROPERTIES_PUBLIC);
        $this->assertEquals(1, count($props));
        $this->assertEquals('name', $props[0]->name);
        $this->assertEquals('John', $props[0]->getValue($object));

        // Protected properties
        $props = Obj::properties($object, Obj::PROPERTIES_PROTECTED);
        $props[0]->setAccessible(true);
        $this->assertEquals(1, count($props));
        $this->assertEquals('surname', $props[0]->name);
        $this->assertEquals('Doe', $props[0]->getValue($object));

        // Private properties
        $props = Obj::properties($object, Obj::PROPERTIES_PRIVATE);
        $props[0]->setAccessible(true);
        $this->assertEquals(1, count($props));
        $this->assertEquals('email', $props[0]->name);
        $this->assertEquals('john.doe@gmail.com', $props[0]->getValue($object));
    }

}
