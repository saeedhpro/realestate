<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(State::all()) == 0) {
            $states = [
                [
                    'id' => 1,
                    'name' => 'آذربایجان شرقی',
                ],
                [
                    'id' => 2,
                    'name' => 'آذربایجان غربی',
                ],
                [
                    'id' => 3,
                    'name' => 'اردبیل',
                ],
                [
                    'id' => 4,
                    'name' => 'اصفهان',
                ],
                [
                    'id' => 5,
                    'name' => 'البرز',
                ],
                [
                    'id' => 6,
                    'name' => 'ایلام',
                ],
                [
                    'id' => 7,
                    'name' => 'بوشهر',
                ],
                [
                    'id' => 8,
                    'name' => 'تهران',
                ],
                [
                    'id' => 9,
                    'name' => 'چهارمحال و بختیاری',
                ],
                [
                    'id' => 10,
                    'name' => 'خراسان جنوبی',
                ],
                [
                    'id' => 11,
                    'name' => 'خراسان رضوی',
                ],
                [
                    'id' => 12,
                    'name' => 'خراسان شمالی',
                ],
                [
                    'id' => 13,
                    'name' => 'خوزستان',
                ],
                [
                    'id' => 14,
                    'name' => 'زنجان',
                ],
                [
                    'id' => 15,
                    'name' => 'سمنان',
                ],
                [
                    'id' => 16,
                    'name' => 'سیستان و بلوچستان',
                ],
                [
                    'id' => 17,
                    'name' => 'فارس',
                ],
                [
                    'id' => 18,
                    'name' => 'قزوین',
                ],
                [
                    'id' => 19,
                    'name' => 'قم',
                ],
                [
                    'id' => 20,
                    'name' => 'كردستان',
                ],
                [
                    'id' => 21,
                    'name' => 'كرمان',
                ],
                [
                    'id' => 22,
                    'name' => 'كرمانشاه',
                ],
                [
                    'id' => 23,
                    'name' => 'کهگیلویه و بویراحمد',
                ],
                [
                    'id' => 24,
                    'name' => 'گلستان',
                ],
                [
                    'id' => 25,
                    'name' => 'گیلان',
                ],
                [
                    'id' => 26,
                    'name' => 'لرستان',
                ],
                [
                    'id' => 27,
                    'name' => 'مازندران',
                ],
                [
                    'id' => 28,
                    'name' => 'مركزی',
                ],
                [
                    'id' => 29,
                    'name' => 'هرمزگان',
                ],
                [
                    'id' => 30,
                    'name' => 'همدان',
                ],
                [
                    'id' => 31,
                    'name' => 'یزد',
                ],
            ];
            foreach ($states as $state) {
                State::create(['name' => $state['name']]);
            }
        }
    }
}