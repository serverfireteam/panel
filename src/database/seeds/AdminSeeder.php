<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Serverfireteam\Panel\Admin;

class AdminSeeder extends Seeder{
    
    public function run(){
        
        Admin::delete();
        
        Admin::create([
            'email' => 'admin@change.me',
            'password' => bcrypt('12345')
        ]);
    }
    
}
