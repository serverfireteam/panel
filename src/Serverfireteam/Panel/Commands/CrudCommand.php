<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrudCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'panel:crud';

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
       
            $this->info('            [ Wellcome to ServerFireTeam Panel Installations ]       ');

            $crudName = $this->argument('name');
            
            $this->call('panel:createmodel', ['name' => $crudName]);
            
            $this->call('panel:createcontroller', ['name' => $crudName.'Controller']);
            //$createControllerClass = new CreateControllerController($crudName);
            
            
            

            //$this->call('make:controller', ['name' => $crudName.'Controller']);
        
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
                     ['name', InputArgument::REQUIRED, 'required argument names']
                ];
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
