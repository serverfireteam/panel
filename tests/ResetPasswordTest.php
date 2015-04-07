<?php

use Laracasts\TestDummy\Factory as TestDummy;

class ResetPasswordTest extends TestCase {

	public function test_reset_password()
	{
		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard')
		     ->click('Reset Password')
		     ->submitForm('Change Password', ['email' => 'admin@change.me', 'current_password' => 'ooooo',
						      'password' => 'pppppp', 'password_confirmation' => 'pppppp'])
		     ->andSee('Password is not correct!!');

		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard')
		     ->click('Reset Password')
		     ->submitForm('Change Password', ['email' => 'admin@change.me', 'current_password' => 'oooooo',
						      'password' => 'pppppp', 'password_confirmation' => 'ppppp'])
		     ->andSee('Passwords not matched!!');

		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard')
		     ->click('Reset Password')
		     ->submitForm('Change Password', ['email' => 'admin@change.me', 'current_password' => 'oooooo',
						      'password' => 'pppppp', 'password_confirmation' => 'pppppp'])
		     ->andSee('Successfully Changed Your Password!!');
	}
}
