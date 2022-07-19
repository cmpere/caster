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

        $this->assertEquals(
            '123',
            Cast::as('123.126666', 'integer')
        );
        $this->assertEquals(
            '3242',
            Cast::as('3242.126666', 'int')
        );
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

        $this->assertEquals(
            '123.13',
            Cast::as('123.126666', 'currency')
        );
        $this->assertEquals(
            '1578.57',
            Cast::as('1578.56666', 'currency')
        );
        $this->assertEquals(
            '1578.54',
            Cast::as('1578.544466', 'currency')
        );
    }

    /** @test */
    public function it_cast_float()
    {
        $values = ['159', '0001', 12.3633332];
        array_map(function ($it) {
            $this->assertEquals('double', gettype(Cast::as($it, 'float')));
        }, $values);

        $this->assertEquals(
            '123.126666',
            Cast::as('123.126666', 'float')
        );
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
        $values = [['1'], 'true', ' true ', 'false', false, true, ['3', 4], 0, '0', ''];
        array_map(function ($it) {
            $this->assertEquals('boolean', gettype(Cast::as($it, 'boolean')));
        }, $values);
    }

    /** @test */
    public function it_cast_boolean_values()
    {
        $truly = [['1'], 'true', ' true ', true, 3, 'content', ['3', 4]];

        $falsy = [[], 'false', ' false ', false, 0, '', '0'];

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
        $this->assertEquals(
            '123',
            Cast::as('   123456789   ', 'trim|truncate:3')
        );
    }

    /** @test */
    public function it_trim_string_values()
    {
        $this->assertEquals(
            '999',
            Cast::as('     999   ', 'trim')
        );
        $this->assertEquals(
            '999',
            Cast::as('     999   ', 'spaces')
        );
    }

    /** @test */
    public function it_roundup_decimals()
    {
        $this->assertEquals(
            '123.127',
            Cast::as('123.126666', 'roundup:3')
        );
    }

    /** @test */
    public function it_round_float_values()
    {
        $this->assertEquals(
            '123.127',
            Cast::as('123.126666', 'round:3')
        );
        $this->assertEquals(
            '1221.13',
            Cast::as('1221.129316666', 'round:2')
        );
    }

    /** @test */
    public function it_floor_float_values()
    {
        $this->assertEquals(
            '123',
            Cast::as('123.126666', 'floor')
        );
        $this->assertEquals(
            '123',
            Cast::as('123.9999', 'floor')
        );
    }

    /** @test */
    public function it_ceil_float_values()
    {
        $this->assertEquals(
            '124',
            Cast::as('123.126666', 'ceil')
        );
    }

    /** @test */
    public function it_replace_tildes()
    {
        $from = 'á,à,ä,â,ª,Á,À,Â,Ä,é,è,ë,ê,É,È,Ê,Ë,í,ì,ï,î,Í,Ì,Ï,Î,ó,ò,ö,ô,Ó,Ò,Ö,Ô,ú,ù,ü,û,Ú,Ù,Û,Ü,ñ,Ñ,ç,Ç';
        $to   = 'a,a,a,a,a,A,A,A,A,e,e,e,e,E,E,E,E,i,i,i,i,I,I,I,I,o,o,o,o,O,O,O,O,u,u,u,u,U,U,U,U,n,N,c,C';
        $this->assertEquals(
            $to,
            Cast::as($from, 'notilde')
        );
    }

    /** @test */
    public function it_spread_string_on_array()
    {
        $str = '1234567890123456789012345678901234567890';

        $this->assertEquals(
            ['1234567890', '1234567890'],
            Cast::as($str, 'spread:10,2')
        );

        $this->assertEquals(
            ['line1' => '1234567890', 'line2' => '1234567890'],
            Cast::as($str, 'spread:10,2,line1,line2')
        );

        $this->assertEquals(
            ['1234567890', '1234567890', '1234567890', '1234567890'],
            Cast::as($str, 'spread:10')
        );
    }

    /** @test */
    public function it_spread_words_string_on_array()
    {
        $str = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.';

        $this->assertEquals(
            ['Lorem', 'ipsum'],
            Cast::as($str, 'spreadword:4,2')
        );

        $this->assertEquals(
            ['line1' => 'Lorem', 'line2' => 'ipsum'],
            Cast::as($str, 'spreadword:4,2,line1,line2')
        );

        $this->assertEquals(
            ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur,', 'adipisicing', 'elit.'],
            Cast::as($str, 'spreadword:4')
        );

        $this->assertEquals(
            ['Lorem ipsum', 'dolor sit amet', 'consectetur,', 'adipisicing', 'elit.'],
            Cast::as($str, 'spreadword:15')
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
