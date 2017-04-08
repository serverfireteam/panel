<?php namespace Serverfireteam\Panel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Translation;
use Serverfireteam\Panel\Facades\LinksFacade;
use Serverfireteam\Panel\libs;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation;
use Serverfireteam\Panel\Commands;
use Serverfireteam\Panel\Links\ConfigLinkProvider;
use Serverfireteam\Panel\Links\DbLinkProvider;
use Serverfireteam\Panel\Links\LinkProvider;

class PanelServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->publishes([
            __DIR__.'/config/elfinder.php' => config_path('elfinder.php'),
            ]);

        // register zofe\rapyd
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');

        // 'Maatwebsite\Excel\ExcelServiceProvider'
        $this->app->register('Maatwebsite\Excel\ExcelServiceProvider');

    	// Barryvdh\Elfinder\ElfinderServiceProvider
        $this->app->register('Barryvdh\Elfinder\ElfinderServiceProvider');
        

        $this->app['router']->aliasMiddleware('PanelAuth', 'Serverfireteam\Panel\libs\AuthMiddleware');
        
        //middleware Permission
        $this->app['router']->aliasMiddleware(
            'PermissionPanel', 'Serverfireteam\Panel\libs\PermissionCheckMiddleware'
            );

        // set config for Auth

        \Config::set('auth.guards.panel',     ['driver'   => 'session','provider' => 'panel']);
        \Config::set('auth.providers.panel',  ['driver'   => 'eloquent','model'   => \Serverfireteam\Panel\Admin::class]);
        \Config::set('auth.passwords.panel',  ['provider' => 'panel','email'      => 'panelViews::resetPassword','table' => 'password_resets','expire' => 60]);
        
        /*
         * Create aliases for the dependency.
         */
        $loader = AliasLoader::getInstance();
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');
        $loader->alias('Excel', 'Maatwebsite\Excel\Facades\Excel');

        $this->app->singleton('panel::install', function()
        {
            return new \Serverfireteam\Panel\Commands\PanelCommand();
        });

        $this->app->singleton('panel::crud', function()
        {
            return new \Serverfireteam\Panel\Commands\CrudCommand();
        });

        $this->app->singleton('panel::createmodel', function()
        {
         $fileSystem = new Filesystem(); 

         return new \Serverfireteam\Panel\Commands\CreateModelCommand($fileSystem);
     });

        $this->app->singleton('panel::createobserver', function()
        {
         $fileSystem = new Filesystem(); 

         return new \Serverfireteam\Panel\Commands\CreateModelObserverCommand($fileSystem);
     });

        $this->app->singleton('panel::createcontroller', function()
        {
         $fileSystem = new Filesystem();

         return new \Serverfireteam\Panel\Commands\CreateControllerPanelCommand($fileSystem);
     });

        $this->app->singleton(LinkProvider::class, function () {
            return app(config('panel.links') ? ConfigLinkProvider::class : DbLinkProvider::class);
        });

        $loader->alias('Links', LinksFacade::class);

        $this->commands('panel::createmodel');

        $this->commands('panel::createobserver');
        
        $this->commands('panel::createcontroller');

        $this->commands('panel::install');

        $this->commands('panel::crud');

        $this->publishes([
            __DIR__ . '/../../../public' => public_path('packages/serverfireteam/panel')
            ]);

        $this->publishes([
            __DIR__.'/config/panel.php' => config_path('panel.php'),
            ]);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../views', 'panelViews');
        $this->publishes([
            __DIR__.'/../../views' => base_path('resources/views/vendor/panelViews'),
            ]);

        include __DIR__."/../../routes.php";

        $this->loadTranslationsFrom(base_path() . '/vendor/serverfireteam/panel/src/lang', 'panel');
        $this->loadTranslationsFrom(base_path() . '/vendor/serverfireteam/rapyd-laravel/lang', 'rapyd');

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
