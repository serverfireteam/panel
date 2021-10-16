<?php
namespace Serverfireteam\Panel;

//use http\Env\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller {

    public function getEdit() {

        $admin = Admin::find(\Auth::guard('panel')->user()->id);

        $demo = false;
        if (\Config::get('panel.demo') == true) {
            $demo = true;
        }

        if (!$demo && request()->has('del_picture')){
            $file = $admin->getAdminPicture();
            //dd(public_path($file));
            if (!empty($file) && File::exists(public_path($file))){
                File::delete(public_path($file));
            }
            $admin->updateAdminPicture('');
            return \Redirect::to(request()->path());
        }

        return \View('panelViews::editProfile')->with('admin', $admin)->with('demo_status', $demo);
    }

    public function postEdit() {

        $demo = false;
        if (\Config::get('panel.demo') == true) {
            $demo = true;
        }

        $admin  = Admin::find(\Auth::guard('panel')->user()->id);
        $inputs = Request::all();
        request()->validate([
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Check if a profile image has been uploaded
        if (request()->has('picture')) {
            // Get image file
            $image = request()->file('picture');
            // Make a image name based on user name and current timestamp
            $name = Str::slug(request()->input('first_name')).'_'.Str::slug(request()->input('last_name')).'_'.time();
            // Define folder path
            $folder = '/uploads/panel_avatars/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $name = !empty($name) ? $name : str_random(25);
            $file = $image->move(public_path($folder), $name.'.'.$image->getClientOriginalExtension());

            // Set user profile image path in database to filePath
            $admin->updateAdminPicture($filePath);
        }
        //dd($inputs['picture']);
        $admin->update($inputs);
        $admin->save();
        return \View('panelViews::editProfile')->with(
            array(
                'admin'   	  => $admin,
                'message'	  => \Lang::get('panel::fields.successfullEditProfile'),
                'demo_status'  => $demo)
        );
    }
}
