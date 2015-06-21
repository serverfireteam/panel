<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Serverfireteam\Panel\RoleLink;
use Serverfireteam\Panel\Link;

class EditLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('links', function($table)
	        {
        	        $table->string('pattern', 100);
	        });

		Link::create(array(
                	'display' => 'Admins',
                	'url'     => 'Admin',
			'pattern' => 'Admin',
			'main'	  => 1
                ));

		Link::create(array(
                	'display' => 'Roles',
                	'url'     => 'Role',
			'pattern' => 'Role|setRoleLinks',
			'main'	  => 1
                ));

		Link::where('url', '=', 'Link')->update(['pattern' => 'Link']);

		$links = Link::where('url', '=', 'Link')->first();
		if (!empty($links)) {
			RoleLink::create(array(
			    'link_id' => $links->id,
			    'role_id' => 1
			));
		}

		$links = Link::where('url', '=', 'Admin')->first();
		if (!empty($links)) {
			RoleLink::create(array(
			    'link_id' => $links->id,
			    'role_id' => 1
			));
		}

		$links = Link::where('url', '=', 'Role')->first();
		if (!empty($links)) {
			RoleLink::create(array(
			    'link_id' => $links->id,
			    'role_id' => 1
			));
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
