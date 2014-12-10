<?php
namespace Serverfireteam\Panel;

class ProfileController extends \Controller {


    public function getEdit(){
        $admin = Admin::find(\Auth::user()->id); 
        return \View::make('editProfile')->with('admin',$admin);
    }
    
    public function postEdit(){
        $admin = Admin::find(\Auth::user()->id); 
        $inputs = \Input::all();
        $admin->update($inputs);
        $admin->save();
        return \View::make('editProfile')->with(array('admin'=>$admin,
                                                       'message'=>'Successfully Updated Profile' ));
    }
    
}