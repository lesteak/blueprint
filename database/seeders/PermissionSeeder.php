<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Users\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access_cms = Permission::firstOrCreate([
            'slug' => 'access-cms',
        ], [
            'name' => 'Access CMS',
            'description' => 'User can access the CMS',
        ]);

        $roles = EnsoCrud::query('role')->get()->keyBy('slug');
        if ($admin_role = $roles->get('admin')) {
            $admin_role->permissions()->syncWithoutDetaching([$access_cms->getKey()]);
        }
    }
}
