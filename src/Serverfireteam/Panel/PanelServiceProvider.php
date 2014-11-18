<?php namespace Serverfireteam\Panel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;

class PanelServiceProvider extends ServiceProvider
{
    protected $defer = false;
        
    public function register()
    {
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');            
    }
        
    public function boot()
    {
        $this->package('serverfireteam/panel');
        
        
        $base_path = base_path();
        $base_path .= "\\vendor\\serverfireteam\\panel\\src\\views";
        
        \View::addLocation($base_path);
        \View::addNamespace('panelViews', $base_path);  
        
        // Change auth model when in panel
        if (\Request::is('panel*'))
        {
            \Config::set('auth.model', 'Panel');
            \Route::filter('auth', function()
            {
                if (\Auth::guest()){
                        return \Redirect::to('panel/login')->with('message', 'Login Failed');
                }
            });
        }
        Route::get('/panel/{entity}/all', function ($entity) {
            $controller = \App::make('Sadra\\Pack1\\'.$entity.'Controller');
            return $controller->callAction('all', array('entity' => $entity));
        });
    
        Route::any('/panel/{entity}/edit', function ($entity) {
            $controller = \App::make('Sadra\\Pack1\\'.$entity.'Controller');
            return $controller->callAction('edit', array('entity' => $entity));
        });
           

        
        include __DIR__."/../../routes.php";

        AliasLoader::getInstance()->alias('Serverfireteam', 'Serverfireteam\Panel\Serverfireteam');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
