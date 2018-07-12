<?php
/**
 * Created by PhpStorm.
 * User: JM
 * Date: 08/04/2017
 * Time: 15:16
 */

namespace Serverfireteam\Panel\Links;

use Illuminate\Support\Collection;
use Serverfireteam\Panel\Link;

class DbLinkProvider implements LinkProvider
{

    /**
     * @return Collection
     */
    public function getAll ()
    {
        return Link::all();
    }

    /**
     * @return Collection
     */
    public function getMain ()
    {
        return Link::whereMain(true)->get();
    }
}