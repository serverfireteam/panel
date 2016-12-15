<?php
namespace Serverfireteam\Panel;

trait ObservantTrait
{
    public static function bootObservantTrait()
    {
   	   $class = explode('\\', __CLASS__);
   	   $class = array_pop($class);
   	   $namespace = "App\\Observers\\".$class."Observer";
   	   
       if(class_exists($namespace))
       		self::observe(app()->make($namespace));
    }
}