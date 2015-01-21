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
            if (\Session::has('message')){
                $message = \Session::get('message');
            }else{
                $message = 'Please Enter Email Address';
            }
            return \Redirect::to('/panel/login')->with('message', $message)->with('mesType', 'message');
        }
    });
}




Route::group(array('prefix' => 'panel' ,'before' => 'auth'), function()
{    
        // main page for the admin section (app/views/admin/dashboard.blade.php)
        Route::get('/', function()
        {
            $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( Auth::user()->email ) ) ) . "?d=mm&s=128";
            return View::make('panelViews::dashboard')->with('grav_url',$grav_url);
        });
        
        Route::any('/{entity}/{methods}', function ($entity,$methods) {
            $panel_path = \Config::get('panel::config.controllers');
            
            if ( isset($panel_path) ){
               $controller_path = $panel_path.'\\'.$entity.'Controller';                
            } else {
                $controller_path = $entity.'Controller'; 
            }           
           
            try{
                $controller = \App::make($controller_path);                
            }catch(Exception $ex){
                throw new Exception('No Controller Has Been Set for This Model ');               
            }
                                    
            if (!method_exists($controller, $methods)){                
                throw new Exception('Controller does not implement the CrudController methods!');               
            } else {
                return $controller->callAction($methods, array('entity' => $entity));
            }
        });        
        Route::post('/edit',
                array('uses' => 'Serverfireteam\Panel\ProfileController@postEdit'));                  
        Route::get('/edit',
                array('uses' => 'Serverfireteam\Panel\ProfileController@getEdit')); 
        
        Route::get('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@getChangePassword'));
        Route::post('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@postChangePassword'));
});




 Route::post('/panel/login',function(){
 
    \Config::set('auth.model', 'Serverfireteam\Panel\Admin');

    $userdata = array(
            'email' 	=> Input::get('email'),
            'password' 	=> Input::get('password')
    );
    // attempt to do the login
    if (Auth::attempt($userdata,filter_var(Input::get('remember'), FILTER_VALIDATE_BOOLEAN))) {                   
        return Redirect::to('panel');
    } else {	 	
        // validation not successful, send back to form	
        return Redirect::to('panel/login')->with('mesType','error')->with('message', 'Either Password or username is not correct!!');

    }
});

Route::get('/panel/password/reset/{token}', function ($token){
    return View::make('panelViews::passwordReset')->with('token', $token);
});

Route::get('/panel/logout', function (){
           
   Auth::logout(); 
    
   return Redirect::to('panel/login');
});

Route::post('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@postReset'));

Route::get('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@getReset'));

Route::get('/panel/remind',  array('uses' => 'Serverfireteam\Panel\RemindersController@getRemind'));

Route::post('/panel/remind', array('uses' => 'Serverfireteam\Panel\RemindersController@postRemind')); 
  
Route::get('/panel/login', function () {
    
    $message = (Session::has('message') ? Session::get('message') : 'Please Sign In');
    $mesType = (Session::has('mesType') ? Session::get('mesType') : 'message');
    return View::make('panelViews::login')->with('message', $message)->with('mesType', $mesType);
});


 
