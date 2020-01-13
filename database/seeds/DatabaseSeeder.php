<?php

use App\Advertise;
use App\Gallery;
use App\PropertyType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PropertyTypesTableSeeder::class);
        $this->call(PropertiesTableSeeder::class);
        $this->call(RealEstatesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EstateTypesTableSeeder::class);
        $this->call(AdvertisesTableSeeder::class);
        $this->call(VrToursTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(UploadsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
