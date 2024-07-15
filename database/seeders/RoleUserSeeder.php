<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtén todos los usuarios y roles
        $users = User::all();
        $roles = Role::all();

        // Asigna roles aleatoriamente a cada usuario
        foreach ($users as $user) {
            // Asigna entre 1 y 3 roles aleatoriamente a cada usuario
            $user->roles()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
