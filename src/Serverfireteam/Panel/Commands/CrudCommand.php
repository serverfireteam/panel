<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrudCommand extends Command {

	/**	 
	 *
	 * @var string 
	 */ 
	protected $name = 'panel:crud';

	/**	 
	 *
	 * @var string the statement before installation starts
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
       
            $this->info('            [ ServerFireTeam Panel Crud Generator ]       ');

            $crudName = $this->argument('name');
            
            $this->call('panel:createmodel', ['name' => $crudName]);
            
            $this->call('panel:createcontroller', ['name' => $crudName]);
            
            $link = new \Serverfireteam\Panel\Link();
            $link->getAndSave($crudName, $crudName . 's');
            $link->save();
            
            if ( !\Schema::hasTable($crudName) ){
                $this->info('    The Table Corresponding to this Model does not exist in Database!!       ');
                $this->info('                    Please Create this table         ');
            }
        
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
