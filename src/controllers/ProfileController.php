<?php
namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;

class ProfileController extends Controller {

    public function getEdit() {

	$admin = Admin::find(\Auth::user()->id);

        $demo = false;
        if (\Config::get('panel.demo') == true) {
		$demo = true;
        }

        return \View('panelViews::editProfile')->with('admin', $admin)->with('demo_status', $demo);
    }

    public function postEdit() {

        $demo = false;
        if (\Config::get('panel.demo') == true) {
		$demo = true;
        }

        $admin  = Admin::find(\Auth::user()->id);
        $inputs = \Input::all();
        $admin->update($inputs);
        $admin->save();
        return \View('panelViews::editProfile')->with(array('admin'   	  => $admin,
                                                            'message'	  => \Lang::get('panel::fields.successfullEditProfile'),
							    'demo_status' => $demo));
    }
}
