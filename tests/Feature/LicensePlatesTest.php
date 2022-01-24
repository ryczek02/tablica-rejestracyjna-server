<?php

namespace Tests\Feature;

use App\Models\LicensePlate;
use App\Models\Region;
use App\Models\Voivodeship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LicensePlatesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_license_plate_can_be_viewed()
    {
        //Arrange
        $voivodeship = Voivodeship::create([
            'name' => 'opolskie',
            'symbol' => 'O'
        ]);

        $region = Region::create([
            'unique_name' => 'OP',
            'administrative_area_name' => 'Powiat opolski'
        ]);

        $licensePlate = LicensePlate::factory([
            'region' => 'OP',
            'unique_plate' => '53836'
        ])->create();


        $response = $this->get('/api/OP/53836');

        $response->assertSeeText(['opolskie', 'opolski', '53836']);
    }

    /**
     * Test if license plate is showing for not existing region
     *
     * @return void
     */
    public function test_license_plate_not_existing_region(){
        $response = $this->get('/api/TY/53836');
        $response->assertStatus(404);
    }

    /**
     * Testing individual license plate feature only for existing region
     *
     * @return void
     */
    public function test_show_individual_license_plate(){
        $response = $this->get('/api/O1/53836');
        $response->assertSeeText('Tablica indywidualna');
    }
}
