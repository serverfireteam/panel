<?php
namespace Serverfireteam\Panel;

use \App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker as PasswordBrokerContract;

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
            if (\Session::has('message')) {
                $message = \Session::get('message');
            } else {
                $message = \Lang::get('panel::fields.enterEmail');
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
            \Config::set('auth.model', 		'Serverfireteam\Panel\Admin');
            \Config::set('auth.password.email', 'panelViews::resetPassword');

	    $response = \Password::sendResetLink(\Input::only('email'), function($message) {
		$message->subject('Password Reminder');
	    });

            switch ($response) {
                    case PasswordBrokerContract::INVALID_USER:
                            return \Redirect::back()->with('message', \Lang::get($response))->with('mesType', 'error');

                    case PasswordBrokerContract::RESET_LINK_SENT:
                            return \Redirect::back()->with('message', \Lang::get($response))->with('mesType', 'info');
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

	        $response = \Password::reset($credentials, function($user, $password) {
			$user->password = \Hash::make($password);
		        $user->save();
	        });

	        switch ($response) {
			case PasswordBrokerContract::INVALID_PASSWORD:
		                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');
		        case PasswordBrokerContract::INVALID_TOKEN:
		                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');
	                case PasswordBrokerContract::INVALID_USER:
		                return \Redirect::back()->with('message', \Lang::get($response))->with('mesType','error');
		        case PasswordBrokerContract::PASSWORD_RESET:
		                return \Redirect::to('/panel')->with('message', \Lang::get('panel::fields.successfullReset'))->with('mesType','info');
	        }
	}

	public function getChangePassword() {

		$demo = false;
		if (\Config::get('panel.demo') == true) {
			$demo = true;
		}

	        return \View::make('panelViews::passwordChange')->with('demo_status', $demo);
	}

	public function postChangePassword() {

        	\Config::set('auth.model', '\Serverfireteam\Panel\Admin');

	        $user 		 = Admin::find(\Auth::user()->id);
	        $password 	 = \Input::only('current_password');
	        $new_password    = \Input::only('password');
	        $retype_password = \Input::only('password_confirmation');
	        $user_password   = \Auth::user()->password;

	        if (\Hash::check($password['current_password'], $user_password)) {
			if ($new_password['password'] == $retype_password['password_confirmation']) {
		                $user->password = \Hash::make($new_password['password']);
		                $user->save();
		                return \Redirect::to('/panel/changePassword')->with('message', 'Successfully Changed Your Password!!');
		        } else {
		                return \Redirect::to('/panel/changePassword')
			                        ->with('message', 'Passwords not matched!!')
			                        ->with('mesType', 'error');
		        }
		} else {
			return \Redirect::to('/panel/changePassword')
			                     ->with('message', 'Password is not correct!!')
			                     ->with('mesType', 'error');
	        }
	}
}
