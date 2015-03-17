<?php

namespace Serverfireteam\Panel;
use Illuminate\Support\Facades\Session as session;
use App\Http\Controllers\Controller;
class AuthController extends Controller {

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function postLogin()
    {
        \Config::set('auth.model', 'Serverfireteam\Panel\Admin');

        $userdata = array(
                'email' 	=> \Input::get('email'),
                'password' 	=> \Input::get('password')
        );
        // attempt to do the login
        if (\Auth::attempt($userdata,filter_var(\Input::get('remember'), FILTER_VALIDATE_BOOLEAN))) {
            return \Redirect::to('panel');
        } else {
            // validation not successful, send back to form	
<<<<<<< HEAD
            return \Redirect::to('panel/login')->with('message', 'Either Password or username is not correct!!')->with('mesType','error');
        }        
=======
            return \Redirect::to('panel/login')->with('message', \Lang::get('panel::fields.passwordNotCorrect') )->with('mesType','error');
        }
>>>>>>> origin/master
    }
    
    public function getLogin(){
        
<<<<<<< HEAD
        $message = (\Session::has('message') ? \Session::get('message') : 'Please Sign In');
=======
        $message = (\Session::has('message') ? \Session::get('message') : \Lang::get('panel::fields.signIn'));
>>>>>>> origin/master
        $mesType = (\Session::has('mesType') ? \Session::get('mesType') : 'message');
        return \View::make('panelViews::login')->with('message', $message)->with('mesType', $mesType);
    }
    
    public function doLogout(){
        
        \Auth::logout();     
        return \Redirect::to('panel/login');
    }
}