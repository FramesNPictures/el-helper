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

    public function provideBitwiseOperationData()
    {
        return [
            '7 & 0' => [0b111, 0b000, 0b111, 0b111],
            '7 & 1' => [0b111, 0b001, 0b111, 0b110],
            '7 & 3' => [0b111, 0b011, 0b111, 0b100],
            '7 & 4' => [0b111, 0b100, 0b111, 0b011],
            '7 & 5' => [0b111, 0b101, 0b111, 0b010],
            '7 & 6' => [0b111, 0b111, 0b111, 0b000],
            '0 & 0' => [0b000, 0b000, 0b000, 0b000],
            '0 & 1' => [0b000, 0b001, 0b001, 0b000],
            '0 & 3' => [0b000, 0b011, 0b011, 0b000],
            '0 & 4' => [0b000, 0b100, 0b100, 0b000],
            '0 & 5' => [0b000, 0b101, 0b101, 0b000],
            '0 & 7' => [0b000, 0b111, 0b111, 0b000],
        ];
    }

    /**
     * @dataProvider provideBitwiseOperationData
     */
    public function testBitwiseOperationData(int $flagSet, int $flag, int $setResult, $clearResult)
    {
        $this->assertEquals($setResult, \Fnp\ElHelper\Flg::set($flagSet, $flag), 'Problem setting flag');
        $this->assertEquals($clearResult, \Fnp\ElHelper\Flg::clear($flagSet, $flag), 'Problem clearing flag');
    }
}