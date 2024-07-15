<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bike;
use App\Modes\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            BikesSeeder::class,
        ]);
        
        User::factory(50)->create();

        $this->call([
            RoleUserSeeder::class,
        ]);
    }
}
