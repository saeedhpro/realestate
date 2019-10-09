<?php

use App\EstateType;
use Illuminate\Database\Seeder;

class EstateTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(EstateType::all()) == 0) {
            $types = [
                ['id' => 1, 'title' => 'خانه'],
                ['id' => 2, 'title' => 'آپارتمان'],
                ['id' => 3, 'title' => 'ویلا'],
                ['id' => 4, 'title' => 'کلنگی'],
                ['id' => 5, 'title' => 'دفتر کار'],
                ['id' => 6, 'title' => 'مطب'],
                ['id' => 7, 'title' => 'مغازه و غرفه'],
                ['id' => 8, 'title' => 'صنعتی'],
                ['id' => 9, 'title' => 'کشاورزی'],
                ['id' => 10, 'title' => 'انبار'],
                ['id' => 11, 'title' => 'برج'],
                ['id' => 12, 'title' => 'باغ'],
                ['id' => 13, 'title' => 'کارگاه'],
                ['id' => 14, 'title' => 'کارخانه'],
                ['id' => 15, 'title' => 'سوله'],
                ['id' => 16, 'title' => 'مشارکتی'],
                ['id' => 17, 'title' => 'مستغلات'],
            ];
            foreach ($types as $type) {
                EstateType::create([
                    'title' => $type['title'],
                ]);
            }
        }
    }
}
