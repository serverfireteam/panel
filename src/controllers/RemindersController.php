<?php
namespace Serverfireteam\Panel;

use \App\Http\Controllers\Controller;

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
            if (\Session::has('message')){
                $message = \Session::get('message');
            }else{
                $message =  \Lang::get('panel::fields.enterEmail'); 
            }
            return \View::make('panelViews::passwordReminder')
                    ->with('message', $message)
                    ->with('mesType', \Session::get('mesType'));
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{            
           
            
            \Config::set('auth.model', 'Serverfireteam\Panel\Admin');  
            \Config::set('auth.reminder.email', 'panelViews::resetPassword');

            
            switch ($response = \Password::remind(\Input::only('email')))
            {
                
                    case \Password::INVALID_USER:
                            return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');

                    case \Password::REMINDER_SENT:
                            return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','info');
            }
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{	
            return \View::make('panelViews::passwordReset');
	}
        
    public function postReset()
    {
       \Config::set('auth.model', 'Serverfireteam\Panel\Admin');    

        $credentials = \Input::only(
           'email', 'password', 'password_confirmation', 'token'
        );
        
       
        
        $response = \Password::reset($credentials, function($user, $password)
        {
            $user->password = \Hash::make($password);
            $user->save();
        });
       
        switch ($response)
        {
            case \Password::INVALID_PASSWORD:
                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');
            case \Password::INVALID_TOKEN:
                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');
            case \Password::INVALID_USER:
                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');

            case \Password::PASSWORD_RESET:
                return \Redirect::to('/panel')->with('message', 'Password Successfully Rested!! Please Log in')->with('mesType','info');
        }
    }

    public function getChangePassword(){
        
        return \View::make('panelViews::passwordChange');
    }

                
    public function postChangePassword(){      
        
        
        \Config::set('auth.model', '\Serverfireteam\Panel\Admin');    
          
        $user = Admin::find(\Auth::user()->id); 
        $password = \Input::only('current_password');
        $new_password = \Input::only('password');
        $retype_password = \Input::only('password_confirmation');
        $user_password = \Auth::user()->password;          
        
        
        
        if (\Hash::check($password['current_password'], $user_password)) {
            if ($new_password['password'] == $retype_password['password_confirmation'] ){                
                $user->password = \Hash::make($new_password['password']);
                $user->save();
                return \Redirect::to('/panel/changePassword')->with('message', 'Successfully Changed Your Password!!');;                    
            }else{
                return \Redirect::to('/panel/changePassword')
                        ->with('message', 'Passwords not matched!!')
                        ->with('mesType', 'error');
            }
        }else{
             return \Redirect::to('/panel/changePassword')
                     ->with('message', 'Password is not correct!!')
                     ->with('mesType', 'error');
        }                                    
    }
        
       
}
