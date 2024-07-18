<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan untuk memeriksa apakah peran sudah ada sebelum membuatnya
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            Role::create(['name' => 'admin']);
        }

        $userRole = Role::where('name', 'user')->first();
        if (!$userRole) {
            Role::create(['name' => 'user']);
        }
    }
}
