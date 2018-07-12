<?php

namespace Serverfireteam\Panel\Database\Seeders;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Spatie\Permission\Models\Role;
use Serverfireteam\Panel\Admin;

class AdminSeeder extends Seeder{
    
    public function run(){
        $role = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => 'access panel'
        ]);

        if ($role->hasPermissionTo('access panel')) {
            $role->givePermissionTo($permission);
        }
        
        // TODO: this delete may be deprecated
        Admin::delete();
        
        Admin::create([
            'email' => 'admin@change.me',
            'password' => bcrypt('12345')
        ]);
    }
    
}
