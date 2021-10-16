<?php


namespace Serverfireteam\Panel\libs\Illuminate\Console;

use Illuminate\Container\Container;

trait DetectsApplicationNamespace
{
    protected function getAppNamespace()
    {
        return Container::getInstance()->getNamespace();
    }

}