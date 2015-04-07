<?php

class ProfileEditTest extends TestCase {

	public function test_edit_profile()
	{
		$this->visit('/panel/login')
		     ->submitForm('Login', ['email' => 'admin@change.me', 'password' => 'oooooo'])
		     ->andSee('Dashboard')
		     ->click('Profile Edit')
		     ->submitForm('Update Profile', ['first_name' => 'test name', 'last_name' => 'test last name', 'email' => 'test@test.com'])
		     ->andSee('Your profile is edited successfully.');
	}
}
