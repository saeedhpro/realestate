<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(Role::all()) == 0){
            Role::create([
                'title' => 'مدیر',
            ]);
            Role::create([
                'title' => 'مشاور املاک',
            ]);
            Role::create([
                'title' => 'کاربر',
            ]);
        }
    }
}
