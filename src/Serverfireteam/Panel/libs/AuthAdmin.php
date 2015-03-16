<?php namespace Serverfireteam\Panel\libs;


class AuthAdmin{


	public function checkLoggedIn(){

            $temp = \Config::get('auth.model');
            \Config::set('auth.model', 'Serverfireteam\Panel\Admin');
            $access = !\Auth::guest();
            \Config::set('auth.model', $temp);
            return $access;		  
	}
}

