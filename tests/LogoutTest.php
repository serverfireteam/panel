<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class LogoutTest extends TestCase {

	public function test_logout()
	{
		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard')
		     ->click('Log out')
		     ->seePageIs('/panel/login');
	}
}
