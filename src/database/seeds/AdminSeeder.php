<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminSeeder extends Seeder{
    
    public function run(){
        
        DB::table('sf_admins')->delete();
        
        DB::table('sf_admins')->insert(
              array('email'=>'admin@admin.com',
                   'password'=>'123')  
        );
    }
    
}