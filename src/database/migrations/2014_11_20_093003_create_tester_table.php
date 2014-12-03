<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
              Schema::create('tester', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			
			$table->engine = 'InnoDB';
			$table->unique('email');
			
		});
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
