<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'Berlin',
            'latitude' => '52.519881',
            'longitude' => '13.407338',
        ]);

        City::create([
            'name' => 'London',
            'latitude' => '51.507351',
            'longitude' => '-0.127660',
        ]);

        City::create([
            'name' => 'Paris',
            'latitude' => '48.856663',
            'longitude' => '2.351556',
        ]);
    }
}
