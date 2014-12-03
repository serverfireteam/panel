<?php

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

Route::get('/panel/logout', function (){
           
   Auth::logout(); 
    
   return Redirect::to('panel/login');
});


Route::get('/panel/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@getChangePassword'));

Route::post('/panel/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@postChangePassword'));

Route::post('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@postReset'));

Route::get('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@getReset'));

Route::get('/panel/remind',  array('uses' => 'Serverfireteam\Panel\RemindersController@getRemind'));

Route::post('/panel/remind', array('uses' => 'Serverfireteam\Panel\RemindersController@postRemind')); 
/*
Route::get('/panel', function () {
  return View::make('panelViews::dashboard');
});
 */      
Route::get('/panel/login', function () {
   return View::make('panelViews::login');
});


 
