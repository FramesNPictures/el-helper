<?php

use Fnp\Helper\Str;
use PHPUnit\Framework\TestCase;

class StrHelperTest extends TestCase
{
    public function provideCamelTestData()
    {
        return [
            ['username', 'username'],
            ['user_name', 'userName'],
            ['USER_NAME', 'userName'],
            ['USER-NAME', 'userName'],
            ['userName', 'userName'],
            ['userName2', 'userName2'],
            ['address_line_1', 'addressLine1'],
            ['address_line_2', 'addressLine2'],
            ['addressLine_1', 'addressLine1'],
            ['address_line2', 'addressLine2'],
            ['help_line_911', 'helpLine911'],
            ['help_line911', 'helpLine911'],
            ['TECHNOLOGY_ALL', 'technologyAll'],
            ['TECHNOLOGY', 'technology'],
        ];
    }

    public function provideSnakeTestData()
    {
        return [
            ['username', 'username'],
            ['user_name', 'user_name'],
            ['USER_NAME', 'user_name'],
            ['userName', 'user_name'],
            ['address_line_1', 'address_line_1'],
            ['address_line_2', 'address_line_2'],
            ['addressLine_1', 'address_line_1'],
            ['address_line2', 'address_line_2'],
            ['helpLine911', 'help_line_911'],
            ['HELP_LINE911', 'help_line_911'],
            ['helpLine911', 'help_line_911'],
            ['TECHNOLOGY_ALL', 'technology_all'],
            ['TECHNOLOGY', 'technology'],
        ];
    }

    public function provideAllCapsTestData()
    {
        return [
            ['THISisATEST', FALSE],
            ['THISISATEST', TRUE],
            ['this_is_a_TEST', FALSE],
            ['THIS_IS_A-TEST', TRUE],
            ['THIS.IS!A!$TEST', TRUE],
        ];
    }

    /**
     * @test
     *
     * @dataProvider provideAllCapsTestData
     *
     * @param $value
     * @param $isAllCaps
     */
    public function testAllCaps($value, $isAllCaps)
    {
        $this->assertEquals($isAllCaps, Str::isAllCaps($value));
    }

    /**
     * @test
     *
     * @dataProvider provideCamelTestData
     *
     * @param $input
     * @param $output
     */
    public function testCamel($input, $output)
    {
        $this->assertEquals($output, Str::camel($input));
    }

    /**
     * @test
     *
     * @dataProvider provideSnakeTestData
     *
     * @param $input
     * @param $output
     */
    public function testSnake($input, $output)
    {
        $this->assertEquals($output, Str::snake($input));
    }
}
