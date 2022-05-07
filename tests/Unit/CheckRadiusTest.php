<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Traits\PromoCodeTrait;
use Tests\TestCase;


class CheckRadiusTest extends TestCase
{
    use PromoCodeTrait;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedius()
    {

        $is_success = true;

        if ($this->checkRadius("80.51742096658", "41.2775177447585", "33.51393141342239", "36.276558284236195"))
            $is_success = false;

        if (!$this->checkRadius("33.51334090986649", "36.273643778504486", "33.51393141342239", "36.276558284236195"))
            $is_success = false;

        $this->assertTrue($is_success);
    }

    public function testGetPolyLines()
    {
        $is_success = true;

        if (is_null($this->getPolyLines("33.51334090986649", "36.273643778504486", "33.51393141342239", "36.276558284236195")))
            $is_success = false;

        $this->assertTrue($is_success);
    }
}
