<?php
namespace Serverfireteam\Panel\libs;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AppHelper {
    use \Illuminate\Console\AppNamespaceDetectorTrait;

    public function getNameSpace(){
        return $this->getAppNamespace();
    }

    public static function validName($name) {
	   return strpos($name, '.') !== 0;
    }

    public static function access($attr, $path, $data, $volume) {
    	if (strpos(basename($path), '.') === 0) {
    	        return !($attr == 'read');
    	} else {
    	        return null;
    	}
    }

    public static function getModel($entity) {
        if ( in_array($entity, \Serverfireteam\Panel\Link::getMainUrls()) ) {
            $modelClass = 'Serverfireteam\\Panel\\'.$entity;
        } else {
            if (!empty(\Config::get('panel.modelPath'))) {
                $modelClass = $this->getNameSpace() . \Config::get('panel.modelPath') . '\\' . $entity;
            }
            else {
                $modelClass = $this->getNameSpace() . $entity;
            }
            
        }
        return $modelClass;
    }
}
