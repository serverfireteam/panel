<?php
namespace Serverfireteam\Panel\Links;

use Illuminate\Support\Collection;

/**
 * Provides links to be shown in the dashboard
 * @package Serverfireteam\Panel\Links
 */
interface LinkProvider
{

    /**
     * @return Collection
     */
    public function getAll();

    /**
     * @return Collection
     */
    public function getMain();
}