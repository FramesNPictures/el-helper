<?php

use PHPUnit\Framework\TestCase;

class FlgHelperTest extends TestCase
{
    const FLAG_A   = 0b0001;
    const FLAG_B   = 0b0010;
    const FLAG_C   = 0b0100;
    const FLAG_D   = 0b1000;
    const FLAG_ALL = 0b1111;

    public function provideFlagData()
    {
        return [
            'AB test A' => [self::FLAG_A + self::FLAG_B, self::FLAG_A, true],
            'AB test B' => [self::FLAG_A + self::FLAG_B, self::FLAG_B, true],
            'AB test C' => [self::FLAG_A + self::FLAG_B, self::FLAG_C, false],
            'AB test D' => [self::FLAG_A + self::FLAG_B, self::FLAG_D, false],
            'CD test A' => [self::FLAG_C + self::FLAG_D, self::FLAG_A, false],
            'CD test B' => [self::FLAG_C + self::FLAG_D, self::FLAG_B, false],
            'CD test C' => [self::FLAG_C + self::FLAG_D, self::FLAG_C, true],
            'CD test D' => [self::FLAG_C + self::FLAG_D, self::FLAG_D, true],
            'ALL test A' => [self::FLAG_ALL, self::FLAG_A, true],
            'ALL test B' => [self::FLAG_ALL, self::FLAG_B, true],
            'ALL test C' => [self::FLAG_ALL, self::FLAG_C, true],
            'ALL test D' => [self::FLAG_ALL, self::FLAG_D, true],
            'NONE test A' => [0, self::FLAG_A, false],
            'NONE test B' => [0, self::FLAG_B, false],
            'NONE test C' => [0, self::FLAG_C, false],
            'NONE test D' => [0, self::FLAG_D, false],
        ];
    }

    /**
     * @dataProvider provideFlagData
     *
     * @param  int   $flagset
     * @param  int   $test
     * @param  bool  $result
     */
    public function testFlag(int $flagset, int $test, bool $result)
    {
        $this->assertEquals($result, \Fnp\ElHelper\Flg::has($flagset, $test));
        $this->assertEquals(!$result, \Fnp\ElHelper\Flg::not($flagset, $test));
    }
}