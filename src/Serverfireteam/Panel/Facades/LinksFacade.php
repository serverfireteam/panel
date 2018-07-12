<?php

namespace Serverfireteam\Panel\Facades;

use Illuminate\Support\Facades\Facade;
use Serverfireteam\Panel\LinkRepository;

class LinksFacade extends Facade
{
    protected static function getFacadeAccessor ()
    {
        return LinkRepository::class;
    }
}