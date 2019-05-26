<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Serverfireteam\Panel;

use \Serverfireteam\Panel\libs\PanelElements;
use Illuminate\Routing\Controller;
use Symfony\Component\Finder\Finder;

class MainController extends Controller
{


    public function entityUrl($entity, $methods)
    {
        $appHelper = new libs\AppHelper();

        if (\Links::isMain($entity)) {
            $controller_path = 'Serverfireteam\Panel\\'.$entity.'Controller';
        } else {
            $panel_path = \Config::get('panel.controllers');
            if (isset($panel_path)) {
                $controller_path = '\\'.$panel_path.'\\'.$entity.'Controller';
            } else {
                $controller_path = '';
                $finder = new Finder();
                $files = $finder->files()->name($entity."Controller.php")->in(
                    \App::basePath().'/app'
                );
                foreach ($files as $item) {
                    $fileContent = $item->getContents();
                    $controller_path = $this->getNameSpace(
                            $fileContent
                        )."\\".$entity."Controller";
                }
                if ($controller_path === '') {
                    throw new \Exception("Controller not found ( $entity.\"Controller.php\" ) ");
                }
            }
        }

        try {
            $controller = \App::make($controller_path);
        } catch (\Exception $ex) {
            throw new \Exception("Controller not found ( $controller_path ) ");
        }

        if (!method_exists($controller, $methods)) {
            throw new \Exception(
                'Controller does not implement the CrudController methods!'
            );
        } else {
            return $controller->callAction(
                $methods,
                array('entity' => $entity)
            );
        }

    }

    private function getNameSpace($fileContent)
    {
        if (preg_match('#^namespace\s+(.+?);$#sm', $fileContent, $m)) {
            return $m[1];
        }
        return null;
    }
}


