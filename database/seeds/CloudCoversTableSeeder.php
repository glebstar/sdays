<?php

use Illuminate\Database\Seeder;
use App\CloudCover;
use App\City;

class CloudCoversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = City::orderBy('id')->get();

        foreach ($cities as $city) {
            for ($i = 0; $i < 366; $i++) {
                $curDate = time() - (86400 * $i);
                $randomFloat = rand(0, 10) / 10;

                $cloudCover = new CloudCover();
                $cloudCover->city_id = $city->id;
                $cloudCover->date = \Carbon\Carbon::createFromTimestamp($curDate);
                $cloudCover->value = $randomFloat;
                $cloudCover->save();
            }
        }

        /*
        $s = curl_init();

        foreach ($cities as $city) {
            for ($i = 1; $i < 366; $i++) {
                $curDate = time() - (86400 * $i);
                curl_setopt($s, CURLOPT_URL, "https://api.darksky.net/forecast/23c336a88c5809a539fc7bfd240a7f8f/{$city->latitude},{$city->longitude},{$curDate}?exclude=currently,flags,hourly");
                curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($s, CURLOPT_USERAGENT, 'gleb_starkov_api');
                $res = curl_exec($s);
                $data = json_decode($res, true);

                $cloudCover = new CloudCover();
                $cloudCover->city_id = $city->id;
                $cloudCover->date = \Carbon\Carbon::createFromTimestamp($curDate);
                $cloudCover->value = isset($data['daily']['data'][0]['cloudCover']) ? $data['daily']['data'][0]['cloudCover'] : 0;
                $cloudCover->save();
            }
        }

        curl_close($s);
        */
    }
}
