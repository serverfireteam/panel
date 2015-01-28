<?php
namespace Serverfireteam\Panel\libs;

class dashboard
{
    
    public static function create()
    {
        $config = \Config::get('panel::config.crudItems');
        $dashboard = array();
        //Make Dashboard Items
        foreach ( $config as $key => $value ){
            if(class_exists($value))
                $dashboard[] = array(
                    'title'=>$key,
                    'count'=> $value::all()->count(),
                    'showListUrl'=>'panel/'.$value.'/all',
                    'addUrl'=>'panel/'.$value.'/edit',
                     );
            else
                throw new \Exception('Model name doesnt match config.crudItems in '.$value);
        }
         
         return $dashboard;
    }
    
   
    
    
}

