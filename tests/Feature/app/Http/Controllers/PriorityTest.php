<?php

namespace Tests\Feature\app\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Priority;

class PriorityControllerTest extends TestCase
{
    /**@test */
    public function test_showPriorities_returns_all_priorities()
    {

        $found_priority = Priority::find(3);

        $this->assertEquals($found_priority->priority, 'high');

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
