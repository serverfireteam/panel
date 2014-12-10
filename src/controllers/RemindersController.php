<?php
namespace Serverfireteam\Panel;

class RemindersController extends \Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
            return \View::make('panelViews::passwordReminder');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{            
            \Config::set('auth.model', 'Serverfireteam\Panel\Admin');  
            switch ($response = \Password::remind(\Input::only('email')))
            {
                    case \Password::INVALID_USER:
                            return Redirect::back()->with('error', Lang::get($response));

                    case \Password::REMINDER_SENT:
                            return Redirect::back()->with('status', Lang::get($response));
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
               
        public function getChangePassword(){
            
            return \View::make('panelViews::passwordChange');
        }

                
        public function postChangePassword(){
            
            \Config::set('auth.model', 'Serverfireteam\Panel\Admin');    
              
            $user = Admin::find(\Auth::user()->id); 
            $password = \Input::only('current_password');
            $new_password = \Input::only('password');
            $retype_password = \Input::only('password_confirmation');
            $user_password = \Auth::user()->password;          
            if (\Hash::check($password['current_password'], $user_password)) {
                if ($new_password['password'] == $retype_password['password_confirmation'] ){                
                    $user->password = \Hash::make($new_password['password']);
                    $user->save();
                    return \Redirect::to('/panel/changePassword')->with('message', 'Successfully Changed Your PAssword!!');;                    
                }else{
                    return \Redirect::to('/panel/changePassword')
                            ->with('message', 'Passwords not matched!!');
                }
            }else{
                 return \Redirect::to('/panel/changePassword')
                         ->with('message', 'Password is not correct!!');;
            }                                    
        }
        
        /**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
               \Config::set('auth.model', 'Serverfireteam\Panel\Admin');    
              
               $user = Admin::find(\Auth::user()->id);                              
              
            
		$credentials = Input::only(
			'email', 'password', 'password_confirmation'
                );

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}
