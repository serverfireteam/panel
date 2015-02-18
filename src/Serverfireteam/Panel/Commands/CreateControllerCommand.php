<?php namespace  Serverfireteam\Panel\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateControllerPanelCommand extends GeneratorCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'panel:createcontroller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new resource controller class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Controller';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
            if ($this->option('plain'))
            {
                    return __DIR__.'/stubs/controller.plain.stub';
            }

            return base_path().'\vendor\serverfireteam\panel\src\Serverfireteam\Panel\stubs\panelController.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
            $controllersPath = \Config::get('panel.controllers');
            if ( isset($controllersPath) && $controllersPath != NULL  ){
                return $controllersPath;
            } else {                
                return $rootNamespace.'\Http\Controllers';
            }            
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('plain', null, InputOption::VALUE_NONE, 'Generate an empty controller class.'),
		);
	}

}
