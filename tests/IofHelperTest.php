<?php

use Fnp\ElHelper\Iof;
use PHPUnit\Framework\TestCase;

class IofHelperTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_not_be_arrayable(): void
    {
        $i = new ArrayableTestDummy0();
        $this->assertFalse(Iof::arrayable($i));

        $i = ['test' => 'test'];
        $this->assertFalse(Iof::arrayable($i));

        $i = 'Arrayable?';
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

    /**
     * @test
     */
    public function it_should_not_be_jsonable(): void
    {
        $i = null;
        $this->assertFalse(Iof::jsonable($i));

        $i = 'Jsonable?';
        $this->assertFalse(Iof::jsonable($i));

        $i = ['test' => 'test'];
        $this->assertFalse(Iof::jsonable($i));

        $i = new stdClass();
        $this->assertFalse(Iof::jsonable($i));

        $i = new ArrayableTestDummy1();
        $this->assertFalse(Iof::jsonable($i));
    }

    /**
     * @test
     */
    public function it_should_be_jsonable(): void
    {
        $i = new JsonableTestDummy0();
        $this->assertTrue(Iof::jsonable($i));
    }

    /**
     * @test
     */
    public function it_should_not_be_stringable(): void
    {
        $i = null;
        $this->assertFalse(Iof::jsonable($i));

        $i = 'Stringable?';
        $this->assertFalse(Iof::jsonable($i));

        $i = ['test' => 'test'];
        $this->assertFalse(Iof::jsonable($i));

        $i = new stdClass();
        $this->assertFalse(Iof::jsonable($i));

        $i = new ArrayableTestDummy1();
        $this->assertFalse(Iof::jsonable($i));
    }

    /**
     * @test
     */
    public function it_should_be_stringable(): void
    {
        $i = new StringableTestDummy0();
        $this->assertTrue(Iof::stringable($i));
    }

    /**
     * @test
     */
    public function it_should_not_be_serializable(): void
    {
        $i = new class() {};

        $this->assertFalse(Iof::serializable($i));
    }

    /**
     * @test
     */
    public function it_should_be_serializable(): void
    {
        $i = new class() {
            public function __serialize(): array
            {
                return ['a' => 'a', 'b' => 'b'];
            }
        };

        $this->assertTrue(Iof::serializable($i));
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

class JsonableTestDummy0 extends ArrayableTestDummy1
{
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}

class StringableTestDummy0 extends JsonableTestDummy0
{
    public function __toString(): string
    {
        return $this->toJson();
    }
}
