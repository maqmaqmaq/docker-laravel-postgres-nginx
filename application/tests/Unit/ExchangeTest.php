<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExchangeTest extends TestCase
{
    public function testRoutesCourses()
    {
        $response = $this->get('/api/courses');

        $response->assertStatus(200);
    }

    public function testRoutesOldCourses()
    {
        $response = $this->get('/api/courses/EUR/');

        $response->assertStatus(200);
    }

    public function testRoutesSaveCourses()
    {
        $response = $this->get('/api/save_courses/');

        $response->assertStatus(200);
    }
}
