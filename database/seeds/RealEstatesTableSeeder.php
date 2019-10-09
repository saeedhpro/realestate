<?php

use App\RealEstate;
use Illuminate\Database\Seeder;

class RealEstatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(RealEstate::all()) == 0){
            $data = [
                'name' => 'مشاور املاک آسمانه',
                'image' => '/images/main/no-image.png',
                'email'=> 'asemaneh@gmail.com',
                'password' => bcrypt('123456789'),
                'address' => 'همدان - میدان عمار',
                'phone' => '+989381234567',
                'state_id' => 30,
                'city_id' => 1225
            ];
            RealEstate::create($data);
        }
    }
}
