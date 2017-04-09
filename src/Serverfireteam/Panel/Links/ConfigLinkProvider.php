<?php
/**
 * Created by PhpStorm.
 * User: JM
 * Date: 08/04/2017
 * Time: 15:16
 */

namespace Serverfireteam\Panel\Links;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConfigLinkProvider implements LinkProvider
{

    /**
     * @return Collection
     */
    public function getAll ()
    {
        // Use the links from config/panel.php
        $config = config('panel.links');

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
    }

    /**
     * @return Collection
     */
    public function getMain ()
    {
        return $this->getAll()->filter(function ($link) {
            return $link['main'];
        });
    }
}