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
}