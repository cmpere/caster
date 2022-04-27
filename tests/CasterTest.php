<?php

namespace Tests;

use LiaTec\Caster\Cast;
use PHPUnit\Framework\TestCase;

class CasterTest extends TestCase
{
    /** @test */
    public function it_cast_string()
    {
        $values = ['159', 'hello', 12.36];
        array_map(function ($it) {
            $this->assertEquals('string', gettype(Cast::as($it, 'string')));
        }, $values);
    }

    /** @test */
    public function it_cast_integer()
    {
        $values = ['159', '0001', 12.36];
        array_map(function ($it) {
            $this->assertEquals('integer', gettype(Cast::as($it, 'int')));
        }, $values);
    }

    /** @test */
    public function it_cast_int()
    {
        $values = ['159', '0001', 12.36];
        array_map(function ($it) {
            $this->assertEquals('integer', gettype(Cast::as($it, 'int')));
        }, $values);
    }

    /** @test */
    public function it_cast_currency()
    {
        $values = ['159', '0001', 12.36];
        array_map(function ($it) {
            $this->assertEquals('double', gettype(Cast::as($it, 'currency')));
        }, $values);
    }

    /** @test */
    public function it_cast_float()
    {
        $values = ['159', '0001', 12.3633332];
        array_map(function ($it) {
            $this->assertEquals('double', gettype(Cast::as($it, 'float')));
        }, $values);
    }

    /** @test */
    public function it_cast_double()
    {
        $values = ['159', '0001', 12.3633332];
        array_map(function ($it) {
            $this->assertEquals('double', gettype(Cast::as($it, 'double')));
        }, $values);
    }

    /** @test */
    public function it_cast_date()
    {
        $date = Cast::as('18-ene-2022', 'date');
        $this->assertEquals('2022', $date->year);
        $this->assertEquals('1', $date->month);
        $this->assertEquals('18', $date->day);

        $date = Cast::as('15-11-1985', 'date');
        $this->assertEquals('1985', $date->year);
        $this->assertEquals('11', $date->month);
        $this->assertEquals('15', $date->day);

        $date = Cast::as('2022-02-25', 'date');
        $this->assertEquals('2022', $date->year);
        $this->assertEquals('02', $date->month);
        $this->assertEquals('25', $date->day);

        $date = Cast::as('2022-02', 'date');
        $this->assertEquals('2022', $date->year);
        $this->assertEquals('02', $date->month);

        $date = Cast::as('2022-feb', 'date');
        $this->assertEquals('2022', $date->year);
        $this->assertEquals('2', $date->month);

        $date = Cast::as('jun-1985', 'date');
        $this->assertEquals('1985', $date->year);
        $this->assertEquals('6', $date->month);
    }

    /** @test */
    public function it_cast_array()
    {
        $values = [['1'], ['2', '3'], ['3', 4]];
        array_map(function ($it) {
            $this->assertEquals('array', gettype(Cast::as($it, 'array')));
        }, $values);
    }

    /** @test */
    public function it_cast_boolean()
    {
        $values = [['1'], 'true', ' true ', 'false', false, true, ['3', 4]];
        array_map(function ($it) {
            $this->assertEquals('boolean', gettype(Cast::as($it, 'boolean')));
        }, $values);
    }

    /** @test */
    public function it_cast_boolean_values()
    {
        $truly = [['1'], 'true', ' true ', true, 3, 'content'];

        $falsy = [[], 'false', ' false ', false, 0];

        array_map(function ($it) {
            $this->assertEquals('boolean', gettype(Cast::as($it, 'boolean')));
            $this->assertTrue(Cast::as($it, 'boolean'));
        }, $truly);

        array_map(function ($it) {
            $this->assertEquals('boolean', gettype(Cast::as($it, 'boolean')));
            $this->assertFalse(Cast::as($it, 'boolean'));
        }, $falsy);
    }

    /** @test */
    public function it_chain_casting()
    {
        $this->assertEquals(159.06, Cast::as('   -159.056     ', 'trim|abs|currency'));
    }

    /** @test */
    public function it_truncates_string_values()
    {
        $this->assertEquals(
            '123',
            Cast::as('123456789', 'truncate:3')
        );
    }

    /**
     * @test

     * */
    public function it_throws_exception_if_no_parser_found()
    {
        $this->expectException('Exception');
        Cast::as('as89d79a', 'unknown');
    }
}
