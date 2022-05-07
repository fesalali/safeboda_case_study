<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class EventTest extends TestCase
{

    use DatabaseTransactions;  

    private $event;
    protected function setUp(): void
    {
        parent::setUp();
        $this->event=[
            'name' => "test",
            'lon' => "33.51747290274471",
            'lat' => "36.27751720966585"
        ];
    }


    public function test_user_can_see_list_event()
    {
        $response = $this->get('api/events');
        $response->assertStatus(200);
    }


    public function test_user_can_store_event()
    {

        $response = $this->call('POST', 'api/events', $this->event);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
