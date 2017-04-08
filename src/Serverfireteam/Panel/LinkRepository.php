<?php

namespace Serverfireteam\Panel;

use Illuminate\Support\Collection;
use Serverfireteam\Panel\Links\LinkProvider;

class LinkRepository
{

    /**
     * @var LinkProvider
     */
    private $linkProvider;

    /**
     * LinkRepository constructor.
     * @param LinkProvider $linkProvider
     */
    public function __construct (LinkProvider $linkProvider)
    {
        $this->linkProvider = $linkProvider;
    }

    /**
     * @return Collection
     */
    public function all ()
    {
        // @TODO cache
        return $this->linkProvider->getAll();
    }

    /**
     * Get all the links where "main" is true
     * @return Collection
     */
    public function main ()
    {
        // @TODO cache
        return $this->linkProvider->getMain();
    }

    /**
     * Return whether the given URL (model name) exists amongst the "main" links
     * @param $url
     * @return bool
     */
    public function isMain ($url)
    {
        return $this->main()->pluck('url')->contains($url);
    }
}