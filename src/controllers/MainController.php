<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Serverfireteam\Panel;

use \Serverfireteam\Panel\libs\PanelElements;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class MainController extends Controller {


    public function entityUrl($entity, $methods){
        $uri = Request::path();
        // Get route collection
        $routes = collect(Route::getRoutes()->getRoutes())->reduce(function ($carry = [], $route) {
            starts_with($route->uri(), 'panel/{entity}') ?: $carry[] = $route;

            return  $carry;
        });
        try {
            // If we find a match, take the user there.
            foreach ($routes as $route){
                if ($uri == $route->uri()){
                    $controller_path = $route->getAction()['controller'];
                    $controller_action = explode('@',$controller_path);
                    $controller = \App::make($controller_action[0]);
                    return $controller->callAction($controller_action[1], array());
                    break;
                }
            }
        }
        catch (Exception $e){
            // Otherwise, we didn't find a match so take the user to the admin page.
            return redirect('/panel');
        }

        $appHelper = new libs\AppHelper();

        if ( \Links::isMain($entity)){
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
            throw new \Exception("Controller not found ( $controller_path ) ");
        }
        if (!method_exists($controller, $methods)){
            throw new \Exception('Controller does not implement the CrudController methods!');
        } else {
            return $controller->callAction($methods, array('entity' => $entity));
        }

    }
}


