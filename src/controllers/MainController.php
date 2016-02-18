<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Serverfireteam\Panel;

use \Serverfireteam\Panel\libs\PanelElements;
use Illuminate\Routing\Controller;

class MainController extends Controller {


    public function entityUrl($entity, $methods){


        $appHelper = new libs\AppHelper(); 

        $urls = Link::getMainUrls();

        if ( in_array($entity, $urls)){
            $controller_path = 'Serverfireteam\Panel\\'.$entity.'Controller';
        } else {           
            $panel_path = \Config::get('panel.controllers');
            if ( isset($panel_path) ){               
             $controller_path = '\\'.$panel_path.'\\'.$entity.'Controller';                
         } else {
            $controller_path = $appHelper->getNameSpace().'Http\Controllers\\'.$entity.'Controller';            
        }                        
    }     

    try{
        $controller = \App::make($controller_path);
    }catch(\Exception $ex){
        throw new \Exception("Can not found the Controller ( $controller_path ) ");               
    }

    if (!method_exists($controller, $methods)){                
        throw new \Exception('Controller does not implement the CrudController methods!');               
    } else {
        return $controller->callAction($methods, array('entity' => $entity));
    }
    
}    
}


