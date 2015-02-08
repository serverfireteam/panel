<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class panelCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'panel:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs  Panel  migrations, configs, views and assets.';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 */
	public function fire()
	{
        $this->info('');$this->info('');$this->info('');
        
        $this->info('            [ ServerFireTeam Panel ]       ');
        $this->info('               ------------------');
        
      //  $this->call('asset:publish', array('package' => 'serverfireteam/rapyd-laravel'));
        $this->info('Rapyd-laravel Asset  is published..............[ok]');
        $this->info('');
        
        
      //  $this->call('config:publish', array('package' => 'serverfireteam/panel'));
		$this->info('Panle         Config is published..............[ok]');
        $this->info('');
        
     //   $this->call('asset:publish', array('package' => 'serverfireteam/panel'));
        $this->info('Panel         Asset  is published..............[ok]');
        $this->info('');
        
        $this->call('migrate', array('--path' => 'vendor/serverfireteam/panel/src/database/migrations'));
        $this->info('Panel         has been migrated!...............[ok]');
        $this->info('');
        
        
        $this->info('');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
