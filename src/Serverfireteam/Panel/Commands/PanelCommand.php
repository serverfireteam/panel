<?php namespace Serverfireteam\Panel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\File;

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
	public function handle()
	{
        $this->info('        [ Welcome to ServerFireTeam Panel Installation ]       ');

        $this->info('** publishing elfinder assets');
        $this->call('elfinder:publish');

        $this->info('** publishing panel assets');
        $this->call('vendor:publish', [
            '--tag' => 'panelpublic',
            '--quiet' => null
            //'--force' => 1
        ]);
        $this->info('** publishing panel config');
        $this->call('vendor:publish', [
            '--tag' => 'panelconfig',
            '--quiet' => null
            //'--force' => 1
        ]);
        $this->info('** publishing panel views');
        $this->call('vendor:publish', [
            '--tag' => 'panelviews',
            '--quiet' => null
            //'--force' => 1
        ]);

        $this->call('migrate', array('--path' => 'vendor/serverfireteam/panel/src/database/migrations'));

        $this->call('db:seed', array('--class' => '\Serverfireteam\Panel\LinkSeeder'));

        //will use for elfinder package
        $path = public_path().'/files/';
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0775, true, true);
        }
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

    /**
     * Copy specific directories to destination
     * @param $destination
     * @return bool
     * @throws \ReflectionException
     */
    protected function copyFiles($destination)
    {
        $result = true;
        $directories = array('public');
        $root_path = $this->getRootPath();
        foreach($directories as $dir){
            $path = $root_path.'/'.$dir;
            $success = $this->files->copyDirectory($path, $destination);
            $result = $success && $result;
        }
        return $result;
    }

    /**
     * Find the root path from the vendor dir.
     * @return bool|string
     * @throws \ReflectionException
     */
    protected function getRootPath()
    {
        $reflector = new \ReflectionClass('serverfireteam_panel');
        $path = realpath(dirname($reflector->getFileName()) . '/..');
        return $path;
    }

}
