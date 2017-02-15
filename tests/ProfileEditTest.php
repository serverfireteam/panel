<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileEditTest extends TestCase {

	use DatabaseTransactions;

	public function test_edit_profile()
	{
		$this->visit('/panel/login')
		     ->type('admin@change.me', 'email')
		     ->type('12345', 'password')
		     ->press('Login')
		     ->see('Dashboard')
		     ->click('Profile Edit')
		     ->type('test name', 'first_name')
		     ->type('test last name', 'last_name')
		     ->type('test@test.com', 'email')
		     ->press('Update Profile')
		     ->see('Your profile is edited successfully.');
	}
}
