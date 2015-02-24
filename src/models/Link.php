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
    
    public function getAndSave($url, $display){
        $this->url = $url;
        $this->display = $display;
        $this->save();
    }

    protected $fillable = array('url', 'display');

}
