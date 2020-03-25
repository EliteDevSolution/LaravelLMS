<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create(['name' => 'admin_permission']);
        Permission::create(['name' => 'coordinator_permission']);
        Permission::create(['name' => 'teacher_permission']);
        Permission::create(['name' => 'student_permission']);
        Permission::create(['name' => 'guest_permission']);
    }
}
