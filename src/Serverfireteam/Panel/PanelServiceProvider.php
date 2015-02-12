<?php namespace Serverfireteam\Panel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Translation;
use Serverfireteam\Panel\libs;

class PanelServiceProvider extends ServiceProvider
{
    protected $defer = false;
        
    public function register()
    {
        // register  zofe\rapyd
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');
        // register html service provider 
        $this->app->register('Illuminate\Html\HtmlServiceProvider');

       // 'Maatwebsite\Excel\ExcelServiceProvider'
        $this->app->register('Maatwebsite\Excel\ExcelServiceProvider');
        include __DIR__."/Commands/ServerfireteamCommand.php";
        $this->app['panel::install'] = $this->app->share(function()
        {
            return new \Serverfireteam\Panel\Commands\panelCommand();
        });

        $this->commands('panel::install');
        $this->publishes([
            __DIR__ . '/../../../public' => public_path('packages/serverfireteam/panel')
        ]);
        $this->publishes([
            __DIR__.'/config/panel.php' => config_path('panel.php'),
        ]);
    }
        
    public function boot()
    {        

        $base_path  = base_path();
        $base_path .= "/vendor/serverfireteam/panel/src/views";

        \View::addLocation($base_path);
        \View::addNamespace('panelViews', $base_path);  
        $testModel = new Admin();
        include __DIR__."/../../routes.php";

	$this->loadTranslationsFrom(base_path() . '/vendor/serverfireteam/panel/src/lang', 'panel');

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
