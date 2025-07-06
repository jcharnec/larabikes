<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ⚠️ Limpiar la tabla pivot antes de asignar roles
        DB::table('role_user')->truncate();

        $users = User::all();
        $roles = Role::all();

        foreach ($users as $user) {
            $roleIds = $roles->random(rand(1, 3))->pluck('id')->toArray();
            $user->roles()->attach($roleIds);

            echo "Assigned roles " . implode(', ', $roleIds) . " to user " . $user->id . "\n";
        }
    }
}

