<?php

namespace Serverfireteam\Panel\libs;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class dashboard
{

    /**
     * Dashboard items cache
     * @var array
     */
    public static $dashboardItems;

    /**
     * Either retrieve the dashboard items from cache or from the config/DB if they were not yet cached
     * @return array
     */
    public static function getItems ()
    {
        if (!self::$dashboardItems) {
            self::$dashboardItems = \App::call(self::class . '@create');
        }

        return self::$dashboardItems;
    }

    /**
     * Determine whether to show the given entity type in the panel
     * @param $link
     * @return bool
     */
    private function showLink ($link)
    {
        if (!$link['show_menu']) return false;

        $user = \Auth::guard('panel')->user();

        return $user->hasRole('super') || $user->hasPermission('/' . $link['url'] . '/all');
    }

    /**
     * Return the array of entity types (models / links)
     * to show CRUD interfaces for in the panel
     * @param AppHelper $appHelper
     * @return array
     */
    public function create (AppHelper $appHelper)
    {
        return collect($this->getLinks())

            ->filter(function ($link) {
                return $this->showLink($link);
            })

            ->map(function ($link) use ($appHelper) {

                $modelName = $link['url'];

                $model = $appHelper->getModel($modelName);

                return [
                    'modelName'   => $modelName,
                    'title'       => $link['display'],
                    'count'       => $model::count(),
                    'showListUrl' => 'panel/' . $modelName . '/all',
                    'addUrl'      => 'panel/' . $modelName . '/edit',
                ];
            })

            ->toArray();
    }

    /**
     * Return the collection of links
     * (either from the Link model in the database or from the panel config file)
     * @return array|Collection
     */
    private function getLinks ()
    {
        if (($config = config('panel.links')) !== null) {

            // Use the links from config/panel.php
            return collect($config)->map(function ($spec, $label) {
                if (is_int($label)) { // This is just a string without a key (short notation)
                    $label = $spec;
                    $spec  = null;
                }
                return [
                    'display'   => $label,
                    'url'       => data_get($spec, 'model', Str::singular($label)),
                    'show_menu' => data_get($spec, 'show_menu', true),
                    'main'      => !data_get($spec, 'custom', true),
                ];
            })->values();
        } else
            return \Serverfireteam\Panel\Link::allCached();
    }
}
