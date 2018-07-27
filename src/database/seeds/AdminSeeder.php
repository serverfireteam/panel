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
        $role = Role::firstOrCreate(
            [
                'name' => config('panel.adminRole', 'admin'),
                'guard_name' => 'web'
            ]
        );

        $permission = Permission::firstOrCreate(
            [
                'name' => 'access panel',
                'guard_name' => 'web'
            ]
        );

        if (! $role->hasPermissionTo('access panel')) {
            $role->givePermissionTo($permission);
        }

        if ($this->command->confirm('Create or update a super-admin now?', true)) {
            $adminEmail = $this->command->ask('Email: ', 'admin@change.me');
            $admin = Admin::firstOrNew(
                [
                    'email' => $adminEmail,
                ]
            );
            $admin->name = $this->command->ask('Name: ', $admin->name ?: 'Administrator');
            if (! $admin->password) {
                $admin->password = bcrypt(
                    $this->command->secret(' Password: ', $admin->name ?: '12345')
                );
            }
            $admin->save();
        }
    }
}
