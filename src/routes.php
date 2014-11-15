<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('/panel', function () {
    return 'Hello World Inside Sadra!!';
});



Route::get('/panel/gridtest2', function (){
   
    $grid = DataGrid::source('users');  //same source types of DataSet

    $grid->add('email', 'email', true);
    $grid->add('username', 'username', true);
       
    $configs = Config::get('config.crudItems');
  
    foreach ($configs as $key => $value) {
        Menu::handler('main')->add($key, $value);
    }
    
    Menu::handler('main')->add('home2', 'Homepag22e2');
   
    return View::make('pack1::gridtest2', array(
        'grid' => $grid,
    ));
});
