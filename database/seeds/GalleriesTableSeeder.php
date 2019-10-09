<?php

use App\Gallery;
use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Gallery::all()) == 0){
            Gallery::create([
                'advertise_id' => 1,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 2,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 3,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 1,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 1,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 2,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 2,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 2,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 3,
                'path' => '/images/home.jpg'
            ]);
            Gallery::create([
                'advertise_id' => 3,
                'path' => '/images/home.jpg'
            ]);
        }
    }
}
