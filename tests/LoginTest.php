<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase {

	use DatabaseTransactions;

	public function test_login()
	{
		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard');

		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('ooooo', 'password')
		     ->press('Login')
		     ->see('Either Password or username is not correct!!');

		$this->visit('/panel/login')
		     ->click('Forgot Password')
		     ->seePageIs('/panel/remind')
		     ->type('admin@change.me', 'email')
		     ->press('Send Reminder')
		     ->see('We have e-mailed your password reset link!');
	}
}
