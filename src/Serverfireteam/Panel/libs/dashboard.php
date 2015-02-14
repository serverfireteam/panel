<?php
namespace Serverfireteam\Panel\libs;

class dashboard
{
    public static function create()
    {
        $config    = \Config::get('panel.crudItems');
        $dashboard = array();

        // Make Dashboard Items
        foreach ($config as $key => $value) {

	    $modelName = $value;
            $value     =  "\App\\" . $value;

            if (class_exists($value)) {
                $dashboard[] = array(
                    'title'	  => $key,
                    'count'	  => $value::all()->count(),
                    'showListUrl' => 'panel/' . $modelName . '/all',
                    'addUrl'	  => 'panel/' . $modelName . '/edit',
                     );
            } else {
                throw new \Exception('Model name does not match config.crudItems in ' . $value);
	    }
        }

	return $dashboard;
    }
}
