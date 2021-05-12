<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QtyAPITest extends TestCase
{
    public function test_qty_by_locations_endpoint()
    {
        $test = new DownloadFileTest();
        $test->test_data_is_inserted();
        $this->get("api/qty-by-locations")->assertStatus(200);
    }

    public function test_qty_by_location_endpoint()
    {
        $test = new DownloadFileTest();
        $test->test_data_is_inserted();
        $this->get("api/qty-by-location/buenos_aires")->assertStatus(200);
    }

    public function test_total_doses_endpoint()
    {
        $test = new DownloadFileTest();
        $test->test_data_is_inserted();
        $this->get("api/total-doses")->assertStatus(200);
    }

    public function test_total_first_doses_endpoint()
    {
        $test = new DownloadFileTest();
        $test->test_data_is_inserted();
        $this->get("api/total-first-doses")->assertStatus(200);
    }

    public function test_second_doses_endpoint()
    {
        $test = new DownloadFileTest();
        $test->test_data_is_inserted();
        $this->get("api/total-second-doses")->assertStatus(200);
    }
}
