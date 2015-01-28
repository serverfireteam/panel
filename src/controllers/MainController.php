<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Serverfireteam\Panel;

class MainController extends \Controller {

    public function entityUrl($entity, $methods){
      
        $panel_path = \Config::get('panel::config.controllers');

        if ( isset($panel_path) ){
           $controller_path = $panel_path.'\\'.$entity.'Controller';                
        } else {
            $controller_path = $entity.'Controller'; 
        }           

        try{
            $controller = \App::make($controller_path);                
        }catch(Exception $ex){
            throw new \Exception('No Controller Has Been Set for This Model ');               
        }

        if (!method_exists($controller, $methods)){                
            throw new \Exception('Controller does not implement the CrudController methods!');               
        } else {
            return $controller->callAction($methods, array('entity' => $entity));
        }
    
    }    
}


