<?php

use App\Advertise;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdvertisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Advertise::all()) == 0){
            $advs = [
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_SELL,
                    'estate_type_id' => 1,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان اول',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour' => null,
                    'is_active' => true,
                    'sell' => 10000000,
                    'rent' => null,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 1,
                    'room' => 1,
                    'age' => 1397
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_SELL,
                    'estate_type_id' => 1,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان دوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour' => null,
                    'is_active' => true,
                    'sell' => 10000000,
                    'rent' => null,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 1,
                    'room' => 1,
                    'age' => 1397
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_RENT,
                    'estate_type_id' => 1,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour' => null,
                    'is_active' => true,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 1,
                    'room' => 1,
                    'age' => 1394
                ]
            ];
            foreach($advs as $adv) {
                Advertise::create($adv);
            }
            $adv = Advertise::find(1);
            $adv->properties()->sync([1,4,3,5]);
            $adv = Advertise::find(2);
            $adv->properties()->sync([2,3,5,8,9]);
        }
    }
}
