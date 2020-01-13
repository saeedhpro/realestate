<?php

use App\Upload;
use Illuminate\Database\Seeder;

class UploadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Upload::all())==0){
            Upload::create([
                'name' => 'home.jpg',
                'path' => '/upload/home.jpg',
            ]);
        }
    }
}
