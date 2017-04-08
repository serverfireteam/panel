<?php
namespace Serverfireteam\Panel\libs;


class dashboard
{

    public static $dashboardItems;

    public static function getItems()
    {
        if(!self::$dashboardItems) {
            self::$dashboardItems = self::create();
        }

        return self::$dashboardItems;
    }

    public static function create()
    {
        $config    = \Serverfireteam\Panel\Link::allCached();
        $dashboard = array();

        $appHelper = new AppHelper();

        // Make Dashboard Items
        foreach ($config as $value) {

    	    $modelName = $value['url'];
            /*
            if ( in_array($modelName, self::$urls)) {
               $model = "Serverfireteam\\Panel\\".$modelName;
            } else {
               $model = $appHelper->getNameSpace() . $modelName;
            }
            */
            $model = $appHelper->getModel($modelName);

            //if (class_exists($value)) {
            if($value['show_menu'])
            {
                $user = \Auth::guard('panel')->user();
                if (! $user->hasRole('super'))
                    if (! \Auth::guard('panel')->user()->hasPermission('/' . $modelName . '/all'))
                        continue;
                    
                $dashboard[] = array(
                    'modelName' => $modelName,
                    'title'   => $value['display'],
                    'count'   => $model::count(),
                    'showListUrl' => 'panel/' . $modelName . '/all',
                    'addUrl'      => 'panel/' . $modelName . '/edit',
                );
            }
            
        }

       return $dashboard;
    }
}
