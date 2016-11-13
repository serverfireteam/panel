<?php
namespace Serverfireteam\Panel\Observers;

use Serverfireteam\Panel\Link;

class LinkObserver
{
	/**
     * Listen to the User saving event.
     *
     * @param  Link  $link
     * @return void
     */
    public function saving(Link $link)
    {
       return dump('saving');
    }
    /**
     * [saved description]
     * @param  Link   $link 
     * @return [type]       
     */
    public function saved(Link $link)
    {
       return dump('savied');
    }
}