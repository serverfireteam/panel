<?php

use Laracasts\TestDummy\Factory as TestDummy;

class LogoutTest extends TestCase {

	public function test_logout()
	{
		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard')
		     ->click('Log out')
		     ->onPage('/panel/login');
	}
}
