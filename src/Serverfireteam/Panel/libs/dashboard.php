<?php
namespace Serverfireteam\Panel\libs;


class dashboard
{    
    
    public static function create()
    {
        $urls = \Config::get('panel.panelControllers');
        
        $config    = \Serverfireteam\Panel\Link::all();
        $dashboard = array();

        // Make Dashboard Items
        foreach ($config as $key => $value) {                        

	    $modelName = $value['url'];           
            if ( in_array($modelName, $urls)){
               $model = "Serverfireteam\Panel\\".$modelName;
            }else{
               $model = "\App\\" . $modelName;
            }

            //if (class_exists($value)) {
            $dashboard[] = array(
                'title'	  => $value['display'],
                'count'	  => $model::all()->count(),
                'showListUrl' => 'panel/' . $modelName . '/all',
                'addUrl'	  => 'panel/' . $modelName . '/edit',

            );                          
        }

	return $dashboard;
    }
}
