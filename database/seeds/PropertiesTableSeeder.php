<?php

use App\Advertise;
use App\Property;
use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Property::all()) == 0) {
            $properties = [
                [
                    'title' => 'بالکن',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'پنجره دوجداره',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'لابی',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'برق',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'سند و ملکیت',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'آیفون تصویری',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'روف گاردن',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'ریموت پارکینگ',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'سالن اجتماعات',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'استخر',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'برق و آب اضطراری',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'دوربین مدار بسته',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'انباری',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'آسانسور',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'سونا',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'کمد و دیواری',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'توالت فرنگی',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'هود',
                    'property_type_id' => 1,
                ],
                [
                    'title' => 'گاز صفحه ای',
                    'property_type_id' => 1
                ],
                [
                    'title' => 'بخاری',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'شوفاژ',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'پکیج',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'چیلر',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'کولر گازی',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'کولر آبی',
                    'property_type_id' => 2
                ],
                [
                    'title' => 'سیستم تهویه هوای مرکزی',
                    'property_type_id' => 2
                ],
            ];
            foreach ($properties as $property) {
                Property::create([
                    'title' => $property['title'],
//                    'property_type_id' => $property['property_type_id']
                ]);
            }
        }
    }
}
