<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Rate;
use App\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RateTest extends TestCase
{
    //use RefreshDatabase;

    public function testDatabase()
    {
        // Make call to application...

        $this->assertDatabaseHas('rates', [
            'currency' => 'euro'
        ]);
    }

    public function testSaving()
    {
        $request = factory(\App\Request::class)->create(['id' => 2]);
        $rate = factory(\App\Rate::class)->create(['currency' => 'test_currency','request_id' => 2]);

        $this->assertDatabaseHas('rates', [
            'currency' => 'test_currency'
        ]);

    }
}
