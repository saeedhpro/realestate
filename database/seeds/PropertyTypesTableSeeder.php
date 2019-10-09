<?php

use App\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(PropertyType::all()) == 0) {
            $property_types = ['اصلی', 'گرمایشی و سرمایشی'];
            foreach ($property_types as $property_type) {
                PropertyType::create(['title' => $property_type]);
            }
        }
    }
}
