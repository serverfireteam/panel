<?php namespace Serverfireteam\Panel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Serverfireteam\Panel\libs;

class PanelServiceProvider extends ServiceProvider
{
    protected $defer = false;
        
    public function register()
    {
        // register  zofe\rapyd
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');
        // 'Maatwebsite\Excel\ExcelServiceProvider'
        $this->app->register('Maatwebsite\Excel\ExcelServiceProvider');
        include __DIR__."/Commands/ServerfireteamCommand.php";
        $this->app['panel::install'] = $this->app->share(function()
        {
            return new \Serverfireteam\Panel\Commands\panelCommand();
        });

        $this->commands('panel::install');
        
    }
        
    public function boot()
    {        
        $this->package('serverfireteam/panel');

        $base_path  = base_path();
        $base_path .= "/vendor/serverfireteam/panel/src/views";

        \View::addLocation($base_path);
        \View::addNamespace('panelViews', $base_path);  
        $testModel = new Admin();
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
