<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('links', function($table)
             {
                     $table->increments('id');
                     $table->string('display');
                     $table->string('url');
                     $table->timestamps();
                     // We'll need to ensure that MySQL uses the InnoDB engine to
                     // support the indexes, other engines aren't affected.
                     $table->engine = 'InnoDB';                     
            });
	
	Serverfireteam\Panel\Link::create(array(
                'display' => 'Links',
                'url' =>  'Link'
            ));

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('links');
	}

}
