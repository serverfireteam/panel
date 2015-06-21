<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Serverfireteam\Panel\Admin;

class EditAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admins', function($table)
                {
			$table->integer('role_id')->unsigned();
			$table->dropColumn('permissions');
		});

	        $admin = Admin::find(1);
		$admin->role_id = 1;
		$admin->save();
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
