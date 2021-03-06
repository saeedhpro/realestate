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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_elevator' => true,
                    'unit_price' => 10000000.0 / 100,
                    'sell' => 10000000,
                    'rent' => null,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 100,
                    'room' => 1,
                    'age' => 1397
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_SELL,
                    'estate_type_id' => 4,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان دوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_elevator' => true,
                    'has_parking' => true,
                    'unit_price' => 13504000.0 / 100,
                    'sell' => 13504000,
                    'rent' => null,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 164,
                    'room' => 2,
                    'age' => 1397
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_RENT,
                    'estate_type_id' => 2,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_parking' => true,
                    'unit_price' => 0,
                    'sell' => 1000000,
                    'rent' => 25000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 154,
                    'room' => 4,
                    'age' => 1394
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_RENT,
                    'unit_price' => 0,
                    'estate_type_id' => 1,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_parking' => true,
                    'sell' => 3000000,
                    'rent' => 21200,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 125,
                    'room' => 2,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_elevator' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 130,
                    'room' => 1,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'has_parking' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 95,
                    'room' => 2,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 80,
                    'room' => 1,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 145,
                    'room' => 3,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10650000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5050,
                    'area' => 135,
                    'room' => 2,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 9500000,
                    'rent' => 19000,
                    'lat' => 34.7789,
                    'lng' => 48.5150,
                    'area' => 400,
                    'room' => 6,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7912,
                    'lng' => 48.5159,
                    'area' => 83,
                    'room' => 1,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7989,
                    'lng' => 48.5150,
                    'area' => 75,
                    'room' => 1,
                    'age' => 1394
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_SELL,
                    'estate_type_id' => 1,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'sell' => 98050000,
                    'unit_price' => 98050000 / 100.0,
                    'rent' => null,
                    'lat' => 34.7989,
                    'lng' => 48.5350,
                    'area' => 55,
                    'room' => 1,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7089,
                    'lng' => 48.5150,
                    'area' => 185,
                    'room' => 2,
                    'age' => 1394
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
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 98050000 / 112.0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7919,
                    'lng' => 48.5140,
                    'area' => 112,
                    'room' => 1,
                    'age' => 1394
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_RENT,
                    'estate_type_id' => 6,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'unit_price' => 0,
                    'is_active' => true,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7994,
                    'lng' => 48.5150,
                    'area' => 1,
                    'room' => 1,
                    'age' => 1394
                ],
                [
                    'real_estate_id' => 1,
                    'user_id' => 1,
                    'advertise_type' => Advertise::TYPE_FOR_RENT,
                    'estate_type_id' => 15,
                    'state_id' => 30,
                    'city_id' => 1225,
                    'title' => 'عنوان سوم',
                    'thumbnail' => '/images/main/no-image.png',
                    'description' => 'jdshfkjhfgkjhfdkjhglkdfjgklsjdflkglksjfdg\nkfdjslkdfsjklsdjflkfsdj',
                    'address' => 'تینبساتنیبالنابیل',
                    'video' => null,
                    'vr_tour_id' => null,
                    'is_active' => true,
                    'unit_price' => 98050000 / 100.0,
                    'sell' => 10000000,
                    'rent' => 250000,
                    'lat' => 34.7979,
                    'lng' => 48.5000,
                    'area' => 220,
                    'room' => 4,
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
            $adv = Advertise::find(16);
            $adv->properties()->sync([2,3]);
            $adv = Advertise::find(14);
            $adv->properties()->sync([2,5,9]);
            $adv = Advertise::find(11);
            $adv->properties()->sync([1,4,5,9,10]);
            $adv = Advertise::find(15);
            $adv->properties()->sync([1,10]);
            $adv = Advertise::find(3);
            $adv->properties()->sync([2,8,9]);
            $adv = Advertise::find(12);
            $adv->properties()->sync([4,8,9]);
            $adv = Advertise::find(13);
            $adv->properties()->sync([1,3,7,8,9]);
            $adv = Advertise::find(7);
            $adv->properties()->sync([2,5,18,9]);
            $adv = Advertise::find(5);
            $adv->properties()->sync([3,5,9]);
            $adv = Advertise::find(4);
            $adv->properties()->sync([1,5,10]);
        }
    }
}
