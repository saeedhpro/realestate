<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Settings::all()) == 0){
            Settings::create([
                'name' => 'خانه 360',
                'map_api' => '2d9a80bd0ac9a48eeaca67fe606535a85f8ef57b',
                'about' => '',
                'admin_id' => 1,
                'logo_id' => 1,
                'state_id' => 30,
                'city_id' => 1225,
            ]);
        }
    }
}
