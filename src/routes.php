<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Route::group(array('prefix' => 'panel' ,'before' => 'auth'), function()
{
    
		// main page for the admin section (app/views/admin/dashboard.blade.php)
		Route::get('/', function()
		{
			return View::make('panelViews::dashboard');
		});

});
/*
Route::get('/panel', function () {
  return View::make('panelViews::dashboard');
});
 */      
Route::get('/panel/login', function () {
   return View::make('panelViews::login');
});
Route::post('panel/login',function(){
    $userdata = array(
            'email' 	=> Input::get('email'),
            'password' 	=> Input::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            return Redirect::to('dashboard');

    } else {	 	

            // validation not successful, send back to form	
            return Redirect::to('login');

    }
});