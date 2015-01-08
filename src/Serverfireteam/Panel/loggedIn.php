<?php namespace Serverfireteam\Panel;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'can_edit' => function() {
        $temp = \Config::get('auth.model');
        \Config::set('auth.model', 'Serverfireteam\Panel\Admin');
        $access = !\Auth::guest();
        \Config::set('auth.model', $temp);
        return $access;
    },
];