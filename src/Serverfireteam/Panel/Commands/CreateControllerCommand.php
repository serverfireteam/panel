<?php namespace  Serverfireteam\Panel\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateControllerPanelCommand extends GeneratorCommand {

	/**	
	 *
	 * @var string contains the command name
	 */
	protected $name = 'panel:createcontroller';

	/**	
	 *
	 * @var string contains the description of command
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
	 * @return string Returns the stub file for generating the Controller
	 */
	protected function getStub()
	{
            if ($this->option('plain'))
            {
                    return __DIR__.'/stubs/controller.plain.stub';
            }

            return base_path().'/vendor/serverfireteam/panel/src/Serverfireteam/Panel/stubs/panelController.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string The namespace of the panel's controllers
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
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
            $name = $this->parseName($this->getNameInput()) . 'Controller';

            if ($this->files->exists($path = $this->getPath($name)))
            {
                    return $this->error($this->type.' already exists!');
            }

            $this->makeDirectory($path);

            $this->files->put($path, $this->buildClass($name));

            $this->info($this->type.' created successfully.');
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
