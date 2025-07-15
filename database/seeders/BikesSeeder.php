<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bike;

class BikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Bike::count() == 0) {
            Bike::factory(200)->create();
        } else {
            echo "Bikes table already has data. Skipping seeding.\n";
        }
    }
}
