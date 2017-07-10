<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PanelCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string holds the name of the command
	 */
	protected $name = 'panel:install';

	/**
	 * The console command description.
	 *
	 * @var string holds the description of the command
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
            $this->info('        [ Welcome to ServerFireTeam Panel Installation ]       ');

	    $this->call('elfinder:publish');

            $this->call('vendor:publish');

            $this->call('migrate', array('--path' => 'vendor/serverfireteam/panel/src/database/migrations'));

            $this->call('db:seed', array('--class' => '\Serverfireteam\Panel\LinkSeeder'));
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
