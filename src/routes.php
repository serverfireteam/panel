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
        return View::make('panelViews::dashboard');
    });

    Route::any('/{entity}/{methods}',  array('uses' => 'Serverfireteam\Panel\MainController@entityUrl'));
    Route::any('/{entity}/export/{type}',  array('uses' => 'Serverfireteam\Panel\ExportController@index'));
    Route::post('/edit',array('uses' => 'Serverfireteam\Panel\ProfileController@postEdit'));
    Route::get('/edit',array('uses' => 'Serverfireteam\Panel\ProfileController@getEdit'));

    Route::get('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@getChangePassword'));
    Route::post('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@postChangePassword'));
});



Route::post('/panel/login', array('uses' => 'Serverfireteam\Panel\AuthController@postLogin'));

Route::get('/panel/password/reset/{token}', function ($token){
    return View::make('panelViews::passwordReset')->with('token', $token);
});

Route::get('/panel/logout', array('uses' => 'Serverfireteam\Panel\AuthController@doLogout'));

Route::post('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@postReset'));

Route::get('/panel/reset', array('uses' => 'Serverfireteam\Panel\RemindersController@getReset'));

Route::get('/panel/remind',  array('uses' => 'Serverfireteam\Panel\RemindersController@getRemind'));

Route::post('/panel/remind', array('uses' => 'Serverfireteam\Panel\RemindersController@postRemind')); 
  


Route::get('/panel/login',  array('uses' => 'Serverfireteam\Panel\AuthController@getLogin'));


App::error(function($exception, $code)
{
    switch ($code)
    {
        case 404:
            return Response::view('panelViews::404', array(), 404);
    }
});


 
