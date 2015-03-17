<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateModelCommand extends GeneratorCommand {

	/**
	 *
	 * @var string the console command name
	 */
	protected $name = 'panel:createmodel';
        
       

	/**	 
	 *
	 * @var string the console command dscription
	 */
	protected $description = 'Create a new Controller model class';

	/**
	 * The type of class being generated.
	 *
	 * @var string indicates the type which used for GeneratorCommand
	 */
	protected $type = 'Model';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return base_path().'/vendor/serverfireteam/panel/src/Serverfireteam/Panel/stubs/model.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace;
	}

}
