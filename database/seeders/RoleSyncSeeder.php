<?php
// database/seeders/RoleSyncSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSyncSeeder extends Seeder
{
    public function run(): void
    {
        // Assure les rôles avec le bon guard
        $admin = Role::findOrCreate('admin', 'web');
        $guide = Role::findOrCreate('guide', 'web');

        // Exemple : donner "admin" à l’utilisateur #1 (adapte si besoin)
        if ($user = User::find(1)) {
            $user->syncRoles(['admin']); // ou ->assignRole('admin');
        }
    }
}
