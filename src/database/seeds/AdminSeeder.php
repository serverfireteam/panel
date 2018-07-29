<?php

namespace Serverfireteam\Panel\Database\Seeders;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Serverfireteam\Panel\Admin;

class AdminSeeder extends Seeder
{
    
    public function run()
    {
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => 'access panel',
            'guard_name' => 'web'
        ]);

        if (! $role->hasPermissionTo('access panel')) {
            $role->givePermissionTo($permission);
        }
        
        $admin = Admin::firstOrNew([
            'name' => 'Administrator',
        ]);
        if (! $admin->email) {
            $admin->email = 'admin@change.me';
        }
        if (! $admin->password) {
            $admin->password = bcrypt('12345');
        }
        $admin->save();
    }
}
