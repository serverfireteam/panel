<?php namespace  Serverfireteam\Panel\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class CreateModelObserverCommand extends GeneratorCommand {

	/**	
	 *
	 * @var string contains the command name
	 */
	protected $name = 'panel:createobserver';

	/**	
	 *
	 * @var string contains the description of command
	 */
	protected $description = 'Create a new observer model class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Observer';

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string Returns the stub file for generating the Observer
	 */
	protected function getStub()
	{
        return base_path().'/vendor/serverfireteam/panel/src/Serverfireteam/Panel/stubs/observer.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string The namespace of the panel's observers
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
        return $rootNamespace.'\Observers';
	}
        
     /**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
           	$name = $this->qualifyClass($this->getNameInput());
            
            if ($this->files->exists($path = $this->getPath($name . 'Observer')))
            {
                return $this->error($this->type.' already exists!');
            }

            $this->makeDirectory($path);
            
            $this->files->put($path, $this->buildClass($name));

            $this->info($this->type.' created successfully.');
	}
}
