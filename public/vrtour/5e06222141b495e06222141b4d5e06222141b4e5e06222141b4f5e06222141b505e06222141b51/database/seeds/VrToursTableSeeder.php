<?php

use App\VrTour;
use Illuminate\Database\Seeder;

class VrToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(VrTour::all()) == 0){
            VrTour::create([
                'advertise_id' => 1,
                'title' => null,
                'path' => 'tour'
            ]);
        }
    }
}
