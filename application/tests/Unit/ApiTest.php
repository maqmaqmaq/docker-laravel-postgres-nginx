<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Api;
use Illuminate\Http\Client\ConnectionException;

class ApiTest extends TestCase
{
    public function testGetApiData()
    {
        $api = new Api();

        $response = $api->getData(config('api.host'));

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetApiDataException()
    {
        $api = new Api();

        $this->expectException(ConnectionException::class);

        $api->getData("BAD_ADDRESS".config('api.host'));
    }
}
