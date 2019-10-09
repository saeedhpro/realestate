<?php

use App\Employee;
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
            ];
            $user = User::create($data);
            Employee::create([
                'real_estate_id' => 1,
                'user_id' => $user->id,
                'role_id' => 1,
                'name' => 'Saeed Heydari',
                'image' =>null,
                'email' => 'saeedhpro@gmail.com'
            ]);
        }
    }
}
