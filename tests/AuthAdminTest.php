<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use User;
use Auth;
use App\Admin;
use DB;
use Session;
use Hash;

class AuthAdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_unathorized_user()
    {
        // => redirect to login page and get 302 status
        $response = $this->get('/panel');
        $response->assertStatus(302)
            ->assertRedirect('/panel/login');
    }

    public function test_login_page()
    {
        $response = $this->get('/panel/login');
        $response->assertStatus(200);
    }

    public function test_fail_login()
    {
        $response = $this->withHeaders([])->json('POST', '/panel/login', [
            'email' => 'admin@change.me',
            'password' => 'wrong-password'
            ]);
            $response->assertStatus(302)
                ->assertRedirect('/panel/login');
    }

   public function test_admin_logining()
    {
        $response = $this->withHeaders([])->json('POST', '/panel/login', [
            'email' => 'admin@change.me',
            'password' => 12345
            ]);
            $response->assertStatus(302)
                ->assertRedirect('/panel');
    }

    public function test_logout()
    {
        ### After do logout -> redirect to login page
        // Do login
        Auth::guard('panel')->loginUsingId(1, true); // 1 => admin@change.me
        // is authorized
        $response = $this->get('/panel');
        $response->assertStatus(200);
        // Do logout
        $response = $this->get('/panel/logout');
        // check redirect
        $response->assertStatus(302)
            ->assertRedirect('/panel/login');
        // test an unauthorize page
        $response = $this->get('/panel');
        $response->assertStatus(302)
            ->assertRedirect('/panel/login');
    }

    public function test_add_new_admin () {
        $email = 'fake@fake.fake';
        $data = [
            'email' => $email,
            'password' => 'password',
            'first_name' => 'test',
            'last_name' => 'test',
            'roles' => ['1'], // Super user
            'save' => '1'
        ];
        $adminCount = DB::table('admins')->where('email', $email)
            ->count();
        $this->assertTrue($adminCount == 0);
        //  if ($adminCount) {
        //      DB::table('admins')->where('email', $email)
        //      ->delete();
        //  }
        Auth::guard('panel')->loginUsingId(1, true);
        $response = $this->call('POST', '/panel/Admin/edit?insert=1', $data);
        $adminCount = DB::table('admins')->where('email', $email)
            ->count();
        $this->assertTrue($adminCount == 1);
    }

    public function test_delete_admin () {
        Session::start();
        $email = 'fake@fake.fake';
        $data = [
            '_method' => 'DELETE',
            '_token' => csrf_token()
        ];
        $admin = DB::table('admins')->where('email', $email)
            ->first();
        Auth::guard('panel')->loginUsingId(1, true);
        $response = $this->call('POST', "/panel/Admin/edit?do_delete=$admin->id", $data)
            ->assertStatus(200);
        $adminCount = DB::table('admins')->where('email', $email)
            ->count();
        $this->assertTrue($adminCount == 0);
    }

    public function test_edit_admin ()
    {
        Session::start();
        $email = 'admin@change.me';
        Auth::guard('panel')->loginUsingId(1, true);        
        // Change admin information
        $data = [
            'email'      => $email,
            'first_name' => 'ftest',
            'last_name'  => 'ltest',
            'password'   => 12345,
            'roles'      => ['1'],
            '_method'    => 'PATCH',
            '_token'     => csrf_token(),
            "save"       => "1"
        ];
        $response = $this->call('POST', "/panel/Admin/edit?update=1", $data)
            ->assertStatus(200);

        $admin = DB::table('admins')->where('email', $email)
            ->first();

        $this->assertTrue($admin->first_name == 'ftest' 
            && $admin->last_name == 'ltest'
            && $admin->password  == Hash::check('12345', $admin->password));
    }
}
