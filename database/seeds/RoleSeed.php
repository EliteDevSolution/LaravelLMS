<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo('admin_permission');
        $role->givePermissionTo('coordinator_permission');
        $role->givePermissionTo('teacher_permission');
        $role->givePermissionTo('student_permission');
        $role->givePermissionTo('guest_permission');

        $role = Role::create(['name' => 'Coordinator']);
        $role->givePermissionTo('coordinator_permission');

        $role = Role::create(['name' => 'Teacher']);
        $role->givePermissionTo('teacher_permission');
        
        $role = Role::create(['name' => 'Student']);
        $role->givePermissionTo('student_permission');
        
        $role = Role::create(['name' => 'Guest']);
        $role->givePermissionTo('guest_permission');
    }
}
