<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    protected $fillable = ['url', 'display', 'show_menu'];

    protected $table = 'links';
    
    static $cache = [];
    public static function getAllLinks($forceRefresh = false) // allCached(
    {
        if (!isset(self::$cache['all']) || $forceRefresh) {
            self::$cache['all'] = Link::all();
        }
        return self::$cache['all'];
    }
    public static function getUrls($forceRefresh = false) // returnUrls(
    {
        if (!isset(self::$cache['all_urls']) || $forceRefresh) {
            $configs = Link::allCached($forceRefresh);
            self::$cache['all_urls'] =  $configs->pluck('url')->toArray();
        }
        return self::$cache['all_urls'];
    }
    public static function getMainUrls($forceRefresh = false)
    {
        if (!isset(self::$cache['main_urls']) || $forceRefresh) {
            $configs = Link::where('main', '=', true)->get(['url']);
            self::$cache['main_urls'] = $configs->pluck('url')->toArray();
        }
        return self::$cache['main_urls'];
    }
    public function addNewLink($url, $label, $visibility) // getAndSave(
    {
        $this->url = $url;
        $this->display = $label;
        $this->show_menu = $visibility;
        $this->save();
    }
}