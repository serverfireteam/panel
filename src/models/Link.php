<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {
    
    protected $table = 'links';
    
    public static function returnUrls(){
        $configs = Link::all();
        $urls = array();
        
        foreach ( $configs as $config ){
            $urls[] = $config['url'];                        
        }
        return $urls;
    }

}
