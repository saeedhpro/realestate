<?php

use App\Manager;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count(User::all()) == 0){
            $data = [
                'phone'	=> '+989381412419',
                'password' => bcrypt('23111374'),
                'email' => 'saeedhpro@gmail.com',
                'name' => 'سعید حیدری',
                'type' => User::ADMIN,
                'real_estate_id' => 1,
            ];
            $user = User::create($data);
            $user->save();
        }
    }
}
