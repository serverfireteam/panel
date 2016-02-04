<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    protected $table = 'links';

    static $cache = [];

    public static function allCached($forceRefresh = false)
    {
        if(!isset(static::$cache['all']) || $forceRefresh) {
            static::$cache['all'] = Link::all();
        }

        return static::$cache['all'];
    }

    public static function returnUrls($forceRefresh = false) {

        if(!isset(static::$cache['all_urls']) || $forceRefresh) {
            $configs = Link::allCached($forceRefresh);
            static::$cache['all_urls'] =  $configs->pluck('url')->toArray();
        }

        return static::$cache['all_urls'];
    }

    public static function getMainUrls($forceRefresh = false){

        if(!isset(static::$cache['main_urls']) || $forceRefresh) {
            $configs = Link::where('main', '=', true)->get(['url']);
            static::$cache['main_urls'] = $configs->pluck('url')->toArray();
        }

        return static::$cache['main_urls'];
    }


    public function getAndSave($url, $display){
        $this->url = $url;
        $this->display = $display;
        $this->save();
    }


    protected $fillable = array('url', 'display');

}
