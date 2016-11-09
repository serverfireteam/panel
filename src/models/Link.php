<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;
use Serverfireteam\Panel\ObservantTrait;

class Link extends Model {
    use ObservantTrait;
    protected $table = 'links';

    static $cache = [];

    public static function allCached($forceRefresh = false)
    {
        if (!isset(self::$cache['all']) || $forceRefresh) {
            self::$cache['all'] = Link::all();
        }

        return self::$cache['all'];
    }

    public static function returnUrls($forceRefresh = false) {

        if (!isset(self::$cache['all_urls']) || $forceRefresh) {
            $configs = Link::allCached($forceRefresh);
            self::$cache['all_urls'] =  $configs->pluck('url')->toArray();
        }

        return self::$cache['all_urls'];
    }

    public static function getMainUrls($forceRefresh = false){

        if (!isset(self::$cache['main_urls']) || $forceRefresh) {
            $configs = Link::where('main', '=', true)->get(['url']);
            self::$cache['main_urls'] = $configs->pluck('url')->toArray();
        }

        return self::$cache['main_urls'];
    }


    public function getAndSave($url, $display, $show_menu = true){
        $this->url = $url;
        $this->display = $display;
        $this->show_menu = $show_menu;
        $this->save();
    }


    protected $fillable = array('url', 'display', 'show_menu');


// //get roles user
//     public function role()
//     {
//         return $this->hasOne('Models\Role');
//     }
    
}
