<?php
namespace Serverfireteam\Panel;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Seeder;


class LinkSeeder extends Seeder {

    public function run()
    {        
        $link = Link::where('url', '=', 'Link')->take(1)->get();
        $admin = Link::where('url', '=', 'Admin')->take(1)->get();
        if ( isset($link) ){           
            Link::where('url', '=', 'Link')->update(['main' => true]);
            Link::where('url', '=', 'Admin')->update(['main' => true]);
        } else {
            Serverfireteam\Panel\Link::create(array(
                'display' => 'Links',
                'url' =>  'Link',
                'main' => true
            ));
             Serverfireteam\Panel\Link::create(array(
                'display' => 'Admins',
                'url' =>  'Admin',
                'main' => true
            ));
        }        
    }

}
