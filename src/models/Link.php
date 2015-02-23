<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {
    
    protected $table = 'links';
    
    public static function returnUrls(){
        $configs = Link::all();
        $allUrls = array();
        
        foreach ( $configs as $config ){
            $allUrls[] = $config['url'];                        
        }
        return $allUrls;
    }

    protected $fillable = array('url', 'display');

}
