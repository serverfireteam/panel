<?php

Route::group(array('prefix' => 'panel', 'middleware' => ['web','PanelAuth']), function()
{
	// main page for the admin section (app/views/admin/dashboard.blade.php)

	Route::get('/', function(){


        $version = '';
        try
        {
            $composer_lock = json_decode(File::get(base_path().'/composer.lock'),true);
            foreach($composer_lock['packages'] as $key=>$value){
                if($value['name'] =="serverfireteam/panel")
                    $version =  $value['version'];
            }
        }
        catch (Exception $exception)
        {
            \Log::warning("I can't found composer.lock for laravelpanel ");
        }

        return View::make('panelViews::dashboard')->with('version', $version);
    });

/**
 * Check Permission only on Model Controllers
 */
    Route::group(array('middleware' => ['PermissionPanel']), function()
    {

        Route::any('/{entity}/export/{type}', array('uses' => 'Serverfireteam\Panel\ExportImportController@export'));
        Route::post('/{entity}/import', array('uses' => 'Serverfireteam\Panel\ExportImportController@import'));
        Route::any('/{entity}/{methods}', array('uses' => 'Serverfireteam\Panel\MainController@entityUrl'));
        Route::post('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@postEdit'));
        Route::get('/edit', array('uses' => 'Serverfireteam\Panel\ProfileController@getEdit'));

    });


/**
 * Admin userPassword change
 */
    Route::get('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@getChangePassword'));

    Route::post('/changePassword', array('uses' => 'Serverfireteam\Panel\RemindersController@postChangePassword'));
});
Route::group(array('middleware' => ['web']), function()
{
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
});

Route::group(array('prefix' => 'elfinder', 'middleware' => ['web','PanelAuth']), function()
{
	Route::get('tinymce4/{input_id}', array('uses' => 'Barryvdh\Elfinder\ElfinderController@showPopup'));
});
