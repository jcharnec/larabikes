<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asignar roles específicos a usuarios específicos
        $moderadorRole = Role::where('role', 'moderador')->first();
        $administradorRole = Role::where('role', 'administrador')->first();
        $superusuarioRole = Role::where('role', 'superusuario')->first();
        
        // Puedes asignar roles a usuarios específicos
        $moderadorUser = User::where('email', 'moderador@example.com')->first();
        $administradorUser = User::where('email', 'admin@example.com')->first();
        $superusuarioUser = User::where('email', 'superusuario@example.com')->first();
        
        if ($moderadorUser && $moderadorRole) {
            DB::table('role_user')->insert([
                'user_id' => $moderadorUser->id,
                'role_id' => $moderadorRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($administradorUser && $administradorRole) {
            DB::table('role_user')->insert([
                'user_id' => $administradorUser->id,
                'role_id' => $administradorRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($superusuarioUser && $superusuarioRole) {
            DB::table('role_user')->insert([
                'user_id' => $superusuarioUser->id,
                'role_id' => $superusuarioRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

