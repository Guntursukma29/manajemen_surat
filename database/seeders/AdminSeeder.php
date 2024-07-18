<?php
// AdminSeeder.php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Prodi; // Import Prodi model
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve or create the roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Retrieve or create the default Prodi
        $defaultProdi = Prodi::firstOrCreate(['nama_prodi' => 'Admin Prodi']);

        // Create admin user with admin role and default Prodi
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'prodi_id' => $defaultProdi->id, // Assign default Prodi ID to admin
        ]);
    }
}
