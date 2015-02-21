<?php
namespace Serverfireteam\Panel\libs;


class dashboard
{    
    
    public static function create()
    {
        $urls = array('1' => 'Admin',
              '2' => 'Link'); 
        
        $config    = \Config::get('panel.crudItems');
        $dashboard = array();

        // Make Dashboard Items
        foreach ($config as $key => $value) {

	    $modelName = $value;
            if ( in_array($modelName, $urls)){
               $value = "Serverfireteam\Panel\\".$modelName;
            }else{
               $value = "\App\\" . $modelName;
            }

            //if (class_exists($value)) {
                $dashboard[] = array(
                    'title'	  => $key,
                    'count'	  => $value::all()->count(),
                    'showListUrl' => 'panel/' . $modelName . '/all',
                    'addUrl'	  => 'panel/' . $modelName . '/edit',
                   
                     );
                
          /*      
            } else {
                throw new \Exception('Model name does not match config.crudItems in ' . $value);
	    }
             * 
             */
        }

	return $dashboard;
    }
}
