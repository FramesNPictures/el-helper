<?php

use FNP\ElInstanceOf\Iof;
use PHPUnit\Framework\TestCase;

class ArrayableTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_not_be_arrayable(): void
    {
        $i = new ArrayableTestDummy0();
        $this->assertFalse(Iof::arrayable($i));

        $i = ['test'=>'test'];
        $this->assertFalse(Iof::arrayable($i));

        $i = new stdClass();
        $this->assertFalse(Iof::arrayable($i));
    }

    /**
     * @test
     */
    public function it_should_be_arrayable(): void
    {
        $i = new ArrayableTestDummy1();
        $this->assertTrue(Iof::arrayable($i));
    }
}

class ArrayableTestDummy0
{
    public string $a;
    public string $b;
}

class ArrayableTestDummy1
{
    public string $a;
    public string $b;

    public function toArray()
    {
        return [
            'a' => $this->a,
            'b' => $this->b,
        ];
    }
}