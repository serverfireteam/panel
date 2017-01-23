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
		     ->type('test name', 'forename')
		     ->type('test last name', 'surname')
		     ->type('test@test.com', 'email')
		     ->press('Update Profile')
		     ->see('Your profile is edited successfully.');
	}
}
