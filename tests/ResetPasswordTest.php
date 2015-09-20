<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResetPasswordTest extends TestCase {

	use DatabaseTransactions;

	public function test_reset_password()
	{
		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard')
		     ->click('Change Password')
		     ->type('admin@change.me', 'email')
		     ->type('ooooo', 'current_password')
		     ->type('pppppp', 'password')
		     ->type('pppppp', 'password_confirmation')
		     ->press('Change Password')
		     ->see('Password is not correct!!');

		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard')
		     ->click('Change Password')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'current_password')
		     ->type('pppppp', 'password')
		     ->type('ppppp', 'password_confirmation')
		     ->press('Change Password')
		     ->see('Passwords not matched!!');

		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard')
		     ->click('Change Password')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'current_password')
		     ->type('pppppp', 'password')
		     ->type('pppppp', 'password_confirmation')
		     ->press('Change Password')
		     ->see('Successfully Changed Your Password!!');
	}
}
