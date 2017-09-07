<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Serverfireteam\Panel\Link;
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
	protected $description = 'Create new crud for you';

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
	public function handle()
	{
       
            $this->info('            [ ServerFireTeam Panel Crud Generator ]       ');

            $crudName = $this->argument('name');
            
            $this->call('panel:createmodel', ['name' => $crudName]);
            
            $this->call('panel:createcontroller', ['name' => $crudName]);
            
            Link::create([
                'url' => $crudName,
                'display' => $crudName . 's',
                'show_menu' => true,
            ]);
            
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
