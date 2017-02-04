<?php



//datagrid routing
Burp::get(null, 'page/(\d+)', array('as'=>'page', function($page) {
    BurpEvent::queue('dataset.page', array($page));
}));
Burp::get(null, 'ord=(-?)(\w+)', array('as'=>'orderby', function($direction, $field) {
    $direction = ($direction == '-') ? "DESC" : "ASC";
    BurpEvent::queue('dataset.sort', array($direction, $field));
}))->remove('page');

//todo: dataedit  


Route::get('rapyd-ajax/{hash}', array('as' => 'rapyd.remote', 'uses' => '\Zofe\Rapyd\Controllers\AjaxController@getRemote'));
//Route::controller('rapyd-demo', '\Zofe\Rapyd\Demo\DemoController');


