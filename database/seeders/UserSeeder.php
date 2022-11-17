<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Yadda\Enso\Facades\EnsoCrud;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = EnsoCrud::query('role')->get()->keyBy('slug');
        if (!$superuser_role = $roles->get('superuser')) {
            $superuser_role = EnsoCrud::query('role')->create([
                'name' => 'Super User',
                'slug' => 'superuser',
                'description' => 'Highest level admin. Access all areas',
            ]);
        }

        if (!$admin_role = $roles->get('admin')) {
            $admin_role = EnsoCrud::query('role')->create([
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Site administrators',
            ]);
        }

        if (!$superuser_user = EnsoCrud::query('user')->where('email', 'studio@maya.agency')->first()) {
            $superuser_user = EnsoCrud::query('user')->create([
                'username' => 'Super User',
                'email' => 'studio@maya.agency',
                'password' => Hash::make('changeme'),
            ]);
        }

        $superuser_user->roles()->syncWithoutDetaching([$superuser_role->getKey()]);

        if (!$admin_user = EnsoCrud::query('user')->where('email', 'admin@maya.agency')->first()) {
            $admin_user = EnsoCrud::query('user')->create([
                'username' => 'Admin User',
                'email' => 'admin@maya.agency',
                'password' => Hash::make('changeme'),
            ]);
        }

        $admin_user->roles()->syncWithoutDetaching([$admin_role->getKey()]);

        if (!$user = EnsoCrud::query('user')->where('email', 'user@maya.agency')->first()) {
            $user = EnsoCrud::query('user')->create([
                'username' => 'User',
                'email' => 'user@maya.agency',
                'password' => Hash::make('changeme'),
            ]);
        }
    }
}
