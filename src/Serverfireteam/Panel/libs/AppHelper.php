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
}