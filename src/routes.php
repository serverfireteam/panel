<?php

use Serverfireteam\Panel\libs;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if (\Request::is('panel*'))
{
    \Config::set('auth.model', 'Serverfireteam\Panel\Admin');
    \Route::filter('auth', function()
    {                
        if (\Auth::guest()){                    
             return \Redirect::to('/panel/login')->with('message', 'Login Failed');
        }
    });
}


Route::group(array('prefix' => 'panel' ,'before' => 'auth'), function()
{
    
		// main page for the admin section (app/views/admin/dashboard.blade.php)
        Route::get('/', function()
        {
//            include __DIR__."/../libs/dashboard.php";
           // $dashboard = dashboard::create();
            
            return View::make('panelViews::dashboard');
        });
        
         Route::get('/{entity}/all', function ($entity) {
             try{
                  $controller = \App::make($entity.'Controller');
             }catch(Exception $ex){
                 echo $ex;
                 exit();
             }
            return $controller->callAction('all', array('entity' => $entity));
        });

        /*
        Route::get('/{entity}/all', function ($entity) {
            $controller = \App::make('Serverfireteam\\Panel\\'.$entity.'Controller');
            return $controller->callAction('all', array('entity' => $entity));
        });
    
         * 
         */
        
        Route::any('/{entity}/edit', function ($entity) {
            $controller = \App::make($entity.'Controller');
            return $controller->callAction('edit', array('entity' => $entity));
        });
        
        /*
        Route::any('/{entity}/edit', function ($entity) {
            $controller = \App::make('Serverfireteam\\Panel\\'.$entity.'Controller');
            return $controller->callAction('edit', array('entity' => $entity));
        });
         * 
         */
        
        
       
});

 Route::post('/panel/login',function(){
 
    \Config::set('auth.model', 'Serverfireteam\Panel\Admin');
    $userdata = array(
            'email' 	=> Input::get('email'),
            'password' 	=> Input::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {                   
        return Redirect::to('panel');
    } else {	 	
        // validation not successful, send back to form	
        return Redirect::to('panel/login');
    }
});

 
/*
Route::get('/panel', function () {
  return View::make('panelViews::dashboard');
});
 */      
Route::get('/panel/login', function () {
   return View::make('panelViews::login');
});


 
