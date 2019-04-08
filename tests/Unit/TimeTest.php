<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_knows_the_length()
    {
        $time = factory('App\Time')->make([
            'start' => new Carbon('2018-09-23 19:00:00'),
            'stop' => new Carbon('2018-09-23 19:10:00'),
        ]);

        $this->assertEquals($time->length->minutes, 10);
    }
}
