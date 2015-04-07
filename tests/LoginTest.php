<?php

class LoginTest extends TestCase {

	public function test_login()
	{
		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard');

		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'ooooo'])
		     ->andSee('Either Password or username is not correct!!');

		$this->visit('/panel/login')
		     ->click('Forgot Password')
		     ->onPage('/panel/remind')
		     ->submitForm('Send Reminder', ['email' => 'admin@change.me'])
		     ->andSee('We have e-mailed your password reset link!');
	}
}
