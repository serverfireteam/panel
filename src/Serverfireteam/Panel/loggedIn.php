<?php namespace Serverfireteam\Panel;


class loggedIn{


	public function checkLoggedIn(){
		return [
		    'can_edit' => function() {
		        $temp = \Config::get('auth.model');
		        \Config::set('auth.model', 'Serverfireteam\Panel\Admin');
		        $access = !\Auth::guest();
		        \Config::set('auth.model', $temp);
		        return $access;
		    },
		];
	}
}

