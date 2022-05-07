<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\PromoCode;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class PromoCodeTest extends TestCase
{

    use DatabaseTransactions;
    private $event;
    private $promoCode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->event = Event::create([
            'name' => "test",
            'lon' => "33.51747290274471",
            'lat' => "36.27751720966585"
        ]);


        $this->promoCode = PromoCode::create([
            "event_id" => $this->event->id,
            "available_count" => 300,
            "expiration_date" => "2022-05-25",
            "code"=>"safeboda12"
        ]);
    }

    public function test_user_can_see_list_promo_code()
    {
        $response = $this->get('api/promo_codes');
        $response->assertStatus(200);
    }

    public function test_user_can_see_list_active_promo_code()
    {
        $response = $this->get('api/promo_codes/active');
        $response->assertStatus(200);
    }


    public function test_user_can_see_list_promo_code_in_active()
    {
        $response = $this->get('api/promo_codes/inActive');
        $response->assertStatus(200);
    }

    public function test_user_can_store_promo_codes()
    {

        $response = $this->call('POST', 'api/promo_codes', [
            "event_id" => $this->event->id,
            "available_count" => 300,
            "expiration_date" => "2023-05-25"
        ]);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_user_can_active_promo_codes()
    {

        $response = $this->call('PUT','api/promo_codes/'.$this->promoCode->id.'/active');

        $this->assertEquals(200, $response->getStatusCode());
    }


    public function test_user_can_in_active_promo_codes()
    {

        $response = $this->call('PUT','api/promo_codes/'.$this->promoCode->id.'/inActive');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
