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
	 * fire model and observer model class
	 * @return void
	 */
	public function handle()
	{
		parent::handle();

        $this->call('panel:createobserver', ['name' => $this->argument('name')]);
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		if (!empty(\Config::get('panel.modelPath'))) {
			return $rootNamespace . '\\' . \Config::get('panel.modelPath');
		}
		else {
			return $rootNamespace;
		}
	}

}
